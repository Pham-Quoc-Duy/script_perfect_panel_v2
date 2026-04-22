<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ApiProvider;
use App\Models\ServiceSyncLog;
use Illuminate\Http\Request;

class ServiceSyncLogController extends Controller
{
    public function index(Request $request)
    {
        $logs = ServiceSyncLog::with(['service'])
            ->forDomain()
            ->orderBy('id', 'desc')
            ->paginate(50);

        $unreadCount = ServiceSyncLog::forDomain()->unread()->count();
        $providers   = ApiProvider::orderBy('name')->pluck('name', 'id');

        return view('adminpanel.service_sync_logs.index', compact('logs', 'unreadCount', 'providers'));
    }

    public function data(Request $request)
    {
        $query = ServiceSyncLog::with(['service'])
            ->forDomain()
            ->orderBy('id', 'desc');

        if ($request->filled('change_type')) {
            $query->where('change_type', $request->change_type);
        }
        if ($request->filled('provider_id')) {
            $query->where('provider_id', $request->provider_id);
        }
        if ($request->filled('is_read') && $request->is_read !== '') {
            $query->where('is_read', (bool) $request->is_read);
        }
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $logs        = $query->paginate(50);
        $unreadCount = ServiceSyncLog::forDomain()->unread()->count();

        $items = $logs->map(fn ($log) => [
            'id'            => $log->id,
            'service_id'    => $log->service_id,
            'provider_name' => $log->provider_name,
            'service_api'   => $log->service_api,
            'service_name'  => $log->service?->getName(),
            'change_type'   => $log->change_type,
            'field_changed' => $log->field_changed,
            'old_value'     => $log->old_value,
            'new_value'     => $log->new_value,
            'is_read'       => $log->is_read,
            'created_at'    => $log->created_at->format('Y-m-d H:i:s'),
        ]);

        return response()->json([
            'items'        => $items,
            'unreadCount'  => $unreadCount,
            'total'        => $logs->total(),
            'from'         => $logs->firstItem() ?? 0,
            'to'           => $logs->lastItem() ?? 0,
            'last_page'    => $logs->lastPage(),
            'current_page' => $logs->currentPage(),
        ]);
    }

    public function markRead(Request $request)
    {
        $count = ServiceSyncLog::markAllRead(getDomain());

        return response()->json(['success' => true, 'count' => $count]);
    }

    public function markOne(Request $request, ServiceSyncLog $log)
    {
        $log->update(['is_read' => true]);

        return response()->json(['success' => true]);
    }
}
