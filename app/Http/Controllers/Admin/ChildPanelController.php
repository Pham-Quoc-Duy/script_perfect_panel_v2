<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChildPanel;
use App\Models\User;
use App\Library\CloudflareCustom;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;

class ChildPanelController extends Controller
{
    /**
     * Display list of child panels
     */
    public function index(Request $request): View
    {
        $query = ChildPanel::with('user')
            ->orderBy('created_at', 'desc');

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by domain
        if ($request->filled('domain')) {
            $query->where('domain_panel', 'like', '%' . $request->domain . '%');
        }

        // Filter by user
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        $childPanels = $query->paginate(15);
        $statuses = ['pending', 'completed', 'suspended'];
        $users = User::select('id', 'name', 'email')->orderBy('name')->get();

        return view('admin.child-panels.index', compact('childPanels', 'statuses', 'users'));
    }

    /**
     * Show child panel details
     */
    public function show(ChildPanel $childPanel): View
    {
        $childPanel->load('user');
        $settings = $childPanel->settings ?? [];

        return view('admin.child-panels.show', compact('childPanel', 'settings'));
    }

    /**
     * Update child panel status
     */
    public function updateStatus(Request $request, ChildPanel $childPanel): JsonResponse
    {
        $request->validate([
            'status' => 'required|in:pending,completed,suspended'
        ]);

        $childPanel->update(['status' => $request->status]);

        return response()->json([
            'success' => true,
            'message' => 'Child panel status updated successfully',
            'status' => $childPanel->status
        ]);
    }

    /**
     * Approve child panel (change status to completed)
     */
    public function approve(ChildPanel $childPanel): JsonResponse
    {
        $childPanel->update(['status' => 'completed']);

        return response()->json([
            'success' => true,
            'message' => 'Child panel approved successfully'
        ]);
    }

    /**
     * Suspend child panel
     */
    public function suspend(ChildPanel $childPanel): JsonResponse
    {
        $childPanel->update(['status' => 'suspended']);

        return response()->json([
            'success' => true,
            'message' => 'Child panel suspended successfully'
        ]);
    }

    /**
     * Delete child panel with Cloudflare and cPanel domain deletion
     */
    public function destroy(Request $request, ChildPanel $childPanel): JsonResponse
    {
        try {
            $zoneId = $request->input('zone_id');
            $domainName = $childPanel->domain_panel;
            
            // Initialize Cloudflare and cPanel
            $cloudflare = new CloudflareCustom();
            $cpanel = new \App\Library\CpanelCustom();
            
            // Check if Cloudflare is configured
            $cfConfigStatus = $cloudflare->getConfigStatus();
            if (!$cfConfigStatus['is_configured']) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cloudflare is not properly configured. Missing fields: ' . implode(', ', $cfConfigStatus['missing_fields'])
                ], 400);
            }
            
            // Check if cPanel is configured
            $cpConfigStatus = $cpanel->getConfigStatus();
            if (!$cpConfigStatus['is_configured']) {
                return response()->json([
                    'success' => false,
                    'message' => 'cPanel is not properly configured. Missing fields: ' . implode(', ', $cpConfigStatus['missing_fields'])
                ], 400);
            }
            
            // If zone_id not provided, try to find it from domain name
            if (empty($zoneId) && !empty($domainName)) {
                $findResult = $cloudflare->getZoneIdByDomain($domainName);
                
                if ($findResult['status'] !== 'success') {
                    return response()->json([
                        'success' => false,
                        'message' => 'Could not find Cloudflare zone for domain: ' . $findResult['message'],
                        'error_details' => $findResult
                    ], 400);
                }
                
                $zoneId = $findResult['zone_id'];
                \Log::info('Found Cloudflare zone for domain', [
                    'domain' => $domainName,
                    'zone_id' => $zoneId
                ]);
            }
            
            // Delete from Cloudflare if zone_id exists
            if (!empty($zoneId)) {
                $cfResult = $cloudflare->deleteDomain($zoneId);
                
                if ($cfResult['status'] !== 'success') {
                    $errorMessage = $cfResult['message'] ?? 'Unknown error from Cloudflare API';
                    
                    if (isset($cfResult['data']) && is_array($cfResult['data'])) {
                        $errorDetails = [];
                        if (isset($cfResult['data']['errors']) && is_array($cfResult['data']['errors'])) {
                            foreach ($cfResult['data']['errors'] as $error) {
                                $errorDetails[] = $error['message'] ?? 'Unknown error';
                            }
                        }
                        if (!empty($errorDetails)) {
                            $errorMessage .= ' (' . implode('; ', $errorDetails) . ')';
                        }
                    }
                    
                    return response()->json([
                        'success' => false,
                        'message' => 'Failed to delete domain from Cloudflare: ' . $errorMessage,
                        'error_details' => $cfResult
                    ], 400);
                }
                
                \Log::info('Successfully deleted domain from Cloudflare', [
                    'domain' => $domainName,
                    'zone_id' => $zoneId
                ]);
            } else {
                \Log::warning('Child panel deletion without Cloudflare zone_id', [
                    'panel_id' => $childPanel->id,
                    'domain' => $domainName ?? 'unknown'
                ]);
            }
            
            // Delete from cPanel
            if (!empty($domainName)) {
                $cpResult = $cpanel->deleteDomain($domainName);
                
                // Check if cPanel deletion was successful
                if (!isset($cpResult['cpanelresult']['status']) || $cpResult['cpanelresult']['status'] != 1) {
                    $errorMessage = $cpResult['cpanelresult']['statusmsg'] ?? 'Unknown error from cPanel API';
                    
                    return response()->json([
                        'success' => false,
                        'message' => 'Failed to delete domain from cPanel: ' . $errorMessage,
                        'error_details' => $cpResult
                    ], 400);
                }
                
                \Log::info('Successfully deleted domain from cPanel', [
                    'domain' => $domainName,
                    'result' => $cpResult
                ]);
            } else {
                \Log::warning('Child panel deletion without domain name', [
                    'panel_id' => $childPanel->id
                ]);
            }
            
            // Delete child panel from database only after successful Cloudflare and cPanel deletion
            $childPanel->delete();

            return response()->json([
                'success' => true,
                'message' => 'Child panel and domain deleted successfully from Cloudflare and cPanel'
            ]);
        } catch (\Exception $e) {
            \Log::error('Error deleting child panel', [
                'panel_id' => $childPanel->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Error deleting child panel: ' . $e->getMessage(),
                'error_code' => get_class($e)
            ], 500);
        }
    }

    /**
     * Create domain panel via cPanel
     */
    public function createDomain(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'domain' => 'required|string|regex:/^([a-zA-Z0-9]([a-zA-Z0-9\-]{0,61}[a-zA-Z0-9])?\.)+[a-zA-Z]{2,}$/'
            ]);

            $domain = $request->input('domain');
            
            // Initialize cPanel
            $cpanel = new \App\Library\CpanelCustom();
            
            // Check if cPanel is configured
            $configStatus = $cpanel->getConfigStatus();
            if (!$configStatus['is_configured']) {
                return response()->json([
                    'success' => false,
                    'message' => 'cPanel is not properly configured. Missing fields: ' . implode(', ', $configStatus['missing_fields'])
                ], 400);
            }
            
            // Create domain in cPanel
            $cpanelResult = $cpanel->createDomain($domain);
            
            // Check if cPanel creation was successful
            if (!isset($cpanelResult['cpanelresult']['status']) || $cpanelResult['cpanelresult']['status'] != 1) {
                $errorMessage = $cpanelResult['cpanelresult']['statusmsg'] ?? 'Unknown error from cPanel API';
                
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to create domain in cPanel: ' . $errorMessage,
                    'error_details' => $cpanelResult
                ], 400);
            }
            
            \Log::info('Successfully created domain in cPanel', [
                'domain' => $domain,
                'result' => $cpanelResult
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Domain panel created successfully in cPanel',
                'data' => [
                    'domain' => $domain,
                    'status' => 'created'
                ]
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid domain format: ' . implode(', ', $e->errors()['domain'] ?? ['Unknown error'])
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Error creating domain panel', [
                'domain' => $request->input('domain'),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Error creating domain panel: ' . $e->getMessage(),
                'error_code' => get_class($e)
            ], 500);
        }
    }

    /**
     * Get child panel settings
     */
    public function getSettings(ChildPanel $childPanel): JsonResponse
    {
        return response()->json([
            'success' => true,
            'settings' => $childPanel->settings ?? []
        ]);
    }

    /**
     * Update child panel settings
     */
    public function updateSettings(Request $request, ChildPanel $childPanel): JsonResponse
    {
        $settings = $childPanel->settings ?? [];
        $settings = array_merge($settings, $request->all());
        
        $childPanel->update(['settings' => $settings]);

        return response()->json([
            'success' => true,
            'message' => 'Settings updated successfully',
            'settings' => $childPanel->settings
        ]);
    }
}
