<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Config;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    public function index(Request $request)
    {
        $config = Config::where('domain', $request->getHost())->first() ?? Config::create(['domain' => $request->getHost()]);
        return response()->json(['success' => true, 'data' => $config]);
    }

    public function store(Request $request)
    {
        // Config is singleton per domain, so we update existing or create new
        $config = Config::where('domain', $request->getHost())->first() ?? Config::create(['domain' => $request->getHost()]);
        return $this->update($request);
    }

    public function show(Request $request, $id)
    {
        $config = Config::where('domain', $request->getHost())->first() ?? Config::create(['domain' => $request->getHost()]);
        return response()->json(['success' => true, 'data' => $config]);
    }

    public function update(Request $request)
    {
        $config = Config::where('domain', $request->getHost())->first() ?? Config::create(['domain' => $request->getHost()]);
        
        $config->update($request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'keywords' => 'nullable|string',
            'logo' => 'nullable|string|max:500',
            'favicon' => 'nullable|string|max:500',
            'og_image' => 'nullable|string|max:500',
            'landingpage' => 'nullable|string|max:255',
            'login_page' => 'nullable|string|max:255',
            'default_theme' => 'nullable|string|max:100',
            'default_currency' => 'nullable|string|max:10',
            'default_lang' => 'nullable|string|max:10',
            'timezone' => 'nullable|string|max:100',
            'notice_modal' => 'nullable|string',
            'link_facebook' => 'nullable|string|max:500',
            'link_zalo' => 'nullable|string|max:500',
            'link_telegram' => 'nullable|string|max:500',
            'link_whatsapp' => 'nullable|string|max:500',
            'affiliate_percent' => 'nullable|numeric|min:0|max:100',
            'affiliate_min' => 'nullable|numeric|min:0',
            'affiliate_max' => 'nullable|numeric|min:0',
            'affiliate_status' => 'boolean',
            'markup_retail' => 'nullable|numeric|min:0|max:100',
            'markup_agent' => 'nullable|numeric|min:0|max:100',
            'markup_distributor' => 'nullable|numeric|min:0|max:100',
            'script_header' => 'nullable|string',
            'script_body' => 'nullable|string',
            'script_footer' => 'nullable|string',
            'telegram_bot' => 'nullable|string|max:500',
            'telegram_chat_id' => 'nullable|string|max:500',
            'telegram_status' => 'boolean',
            'smtp_host' => 'nullable|string|max:255',
            'smtp_port' => 'nullable|integer|min:1|max:65535',
            'smtp_username' => 'nullable|string|max:255',
            'smtp_password' => 'nullable|string|max:500',
            'smtp_from_name' => 'nullable|string|max:255',
            'cloudflare_email' => 'nullable|email|max:255',
            'cloudflare_global_key' => 'nullable|string|max:500',
            'cloudflare_account_id' => 'nullable|string|max:255',
            'cloudflare_token' => 'nullable|string|max:500',
            'cloudflare_ip_host' => 'nullable|ip',
            'domain_main' => 'nullable|string|max:255',
            'domain' => 'nullable|array',
            'status' => 'boolean'
        ]));

        return response()->json([
            'success' => true,
            'message' => 'Config updated successfully',
            'data' => $config
        ]);
    }

    public function destroy(Request $request, $id)
    {
        // Config is singleton per domain, reset to defaults instead of delete
        $config = Config::where('domain', $request->getHost())->first();
        if ($config) {
            $config->update([
                'title' => null,
                'description' => null,
                'status' => true
            ]);
        }
        
        return response()->json(['success' => true, 'message' => 'Config reset successfully']);
    }
}