<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Config;
use App\Models\Language;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class SettingController extends Controller
{
    private function showSetting($view, $extraData = [])
    {
        $domain = getDomain();
        $config = Config::where('domain', $domain)->first() ?? new Config();
        $languages = Language::where('status', 1)->where('domain', $domain)->get();
        $data = compact('config', 'languages') + $extraData;
        return view("adminpanel.settings.$view", $data);
    }

    public function general() { return $this->showSetting('general'); }
    public function theme() { return $this->showSetting('theme'); }
    public function design() { return $this->showSetting('design'); }
    public function price() { return $this->showSetting('price'); }
    public function service() { return $this->showSetting('service'); }
    public function product() { return $this->showSetting('product'); }
    public function language() { return $this->showSetting('language'); }
    public function support() { return $this->showSetting('support'); }
    public function security() { return $this->showSetting('security'); }
    public function smtp() { return $this->showSetting('smtp'); }
    public function modules() { return $this->showSetting('modules'); }
    public function social() { return $this->showSetting('social'); }
    public function pricing() { return $this->showSetting('pricing'); }
    public function notifications() { return $this->showSetting('notifications'); }
    public function email() { return $this->showSetting('email'); }
    public function advanced() { return $this->showSetting('advanced'); }
    public function keepOrders() { return $this->showSetting('keep-orders'); }
    public function cloudflare() { return $this->showSetting('cloudflare'); }

    public function currency()
    {
        $domain = getDomain();
        return $this->showSetting('currency', ['currency_settings' => Currency::where('domain', $domain)->get()]);
    }

    private function sendResponse($success, $message, $data = [], $statusCode = 200, Request $request = null)
    {
        if ($request && $request->expectsJson()) {
            return response()->json(array_merge(['success' => $success, 'message' => $message], $data), $statusCode);
        }
        
        $redirect = redirect()->back();
        return $success ? $redirect->with('success', $message) : $redirect->with('error', $message);
    }

    private function updateConfig(Request $request, array $rules, array $fields, $successMsg = 'Cập nhật thành công!')
    {
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            if ($request->expectsJson()) {
                return response()->json(['message' => $validator->errors()->first()], 422);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $domain = getDomain();
            $config = Config::where('domain', $domain)->first() ?? new Config();
            $config->domain = $domain;
            $config->fill($request->only($fields));
            $config->save();
            
            return $this->sendResponse(true, $successMsg, [], 200, $request);
        } catch (\Exception $e) {
            return $this->sendResponse(false, 'Có lỗi xảy ra: ' . $e->getMessage(), [], 500, $request)->withInput();
        }
    }

    public function updateGeneral(Request $request)
    {
        return $this->updateConfig($request, [
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'keywords' => 'nullable|string|max:500',
            'default_currency' => 'nullable|string|max:10',
            'default_lang' => 'nullable|string|max:10',
            'announcement_position' => 'nullable|string|in:modal,page,page_and_modal',
            'announcement_content' => 'nullable|string',
        ], [
            'title', 'description', 'keywords', 'default_currency', 'default_lang',
            'announcement_position', 'announcement_content'
        ]);
    }

    public function updateTerms(Request $request)
    {
        return $this->updateConfig($request, [
            'terms_content' => 'nullable|string',
        ], ['terms_content']);
    }

    public function updateTheme(Request $request)
    {
        return $this->updateConfig($request, [
            'default_theme' => 'nullable|string|in:light,dark',
            'notice_modal' => 'nullable|string|max:2000',
            'domain_main' => 'nullable|string|max:255',
            'domain' => 'nullable|string|max:1000',
            'default_landingpage' => 'nullable|string|max:50',
            'default_login' => 'nullable|string|max:50',
            'default_interface' => 'nullable|string|max:50',
        ], [
            'default_theme', 'notice_modal', 'domain_main', 'domain',
            'default_landingpage', 'default_login', 'default_interface'
        ]);
    }

    public function updateSocial(Request $request)
    {
        return $this->updateConfig($request, [
            'link_facebook' => 'nullable|url|max:500',
            'link_telegram' => 'nullable|url|max:500',
            'link_zalo' => 'nullable|url|max:500',
            'link_whatsapp' => 'nullable|url|max:500',
        ], ['link_facebook', 'link_telegram', 'link_zalo', 'link_whatsapp']);
    }

    public function updatePrice(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'markup_retail' => 'required|numeric|min:0|max:999.99',
            'markup_agent' => 'required|numeric|min:0|max:999.99',
            'markup_distributor' => 'required|numeric|min:0|max:999.99',
            'show_multi_rate' => 'nullable|boolean',
            'min_total_deposit_child_panel' => 'nullable|numeric|min:0',
            'min_total_deposit_reseller' => 'nullable|numeric|min:0',
            'change_price_all' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            if ($request->expectsJson()) {
                return response()->json(['message' => $validator->errors()->first()], 422);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $domain = getDomain();
            $config = Config::where('domain', $domain)->first() ?? new Config();
            $config->domain = $domain;
            $fieldsToUpdate = $request->only(['markup_retail', 'markup_agent', 'markup_distributor']);
            
            if ($request->has('show_multi_rate')) {
                $fieldsToUpdate['show_multi_rate'] = $request->boolean('show_multi_rate');
                if ($request->boolean('show_multi_rate')) {
                    $fieldsToUpdate += $request->only(['min_total_deposit_child_panel', 'min_total_deposit_reseller']);
                }
            }
            
            if (!empty($fieldsToUpdate)) {
                $config->update($fieldsToUpdate);
            }

            if ($request->boolean('change_price_all')) {
                \App\Models\Service::where('domain', $domain)->update([
                    'rate_retail_up' => $request->input('markup_retail'),
                    'rate_agent_up' => $request->input('markup_agent'),
                    'rate_distributor_up' => $request->input('markup_distributor'),
                ]);
            }

            return $this->sendResponse(true, 'Cài đặt giá bán đã được cập nhật thành công!', [], 200, $request);
        } catch (\Exception $e) {
            return $this->sendResponse(false, 'Có lỗi xảy ra: ' . $e->getMessage(), [], 500, $request)->withInput();
        }
    }

    public function updatePricing(Request $request)
    {
        return $this->updateConfig($request, [
            'markup_retail' => 'required|numeric|min:0|max:100',
            'markup_agent' => 'required|numeric|min:0|max:100',
            'markup_distributor' => 'required|numeric|min:0|max:100',
            'affiliate_percent' => 'required|numeric|min:0|max:100',
            'affiliate_min' => 'required|numeric|min:0',
            'affiliate_max' => 'required|numeric|min:0',
            'affiliate_status' => 'required|boolean',
        ], [
            'markup_retail', 'markup_agent', 'markup_distributor',
            'affiliate_percent', 'affiliate_min', 'affiliate_max', 'affiliate_status'
        ]);
    }

    public function updateNotifications(Request $request)
    {
        return $this->updateConfig($request, [
            'telegram_bot' => 'nullable|string|max:255',
            'telegram_chat_id' => 'nullable|string|max:255',
            'telegram_status' => 'required|boolean',
            'notice_system' => 'nullable|string|max:5000',
        ], ['telegram_bot', 'telegram_chat_id', 'telegram_status', 'notice_system']);
    }

    public function updateEmail(Request $request)
    {
        return $this->updateConfig($request, [
            'smtp_host' => 'nullable|string|max:255',
            'smtp_port' => 'nullable|integer|min:1|max:65535',
            'smtp_username' => 'nullable|string|max:255',
            'smtp_password' => 'nullable|string|max:255',
            'smtp_from_name' => 'nullable|string|max:255',
        ], ['smtp_host', 'smtp_port', 'smtp_username', 'smtp_password', 'smtp_from_name']);
    }

    public function updateAdvanced(Request $request)
    {
        return $this->updateConfig($request, [
            'script_header' => 'nullable|string',
            'script_body' => 'nullable|string',
            'script_footer' => 'nullable|string',
        ], ['script_header', 'script_body', 'script_footer']);
    }

    public function updateCustomCss(Request $request)
    {
        return $this->updateConfig($request, [
            'script_header' => 'nullable|string',
            'script_css' => 'nullable|string',
            'script_footer' => 'nullable|string',
        ], ['script_header', 'script_css', 'script_footer']);
    }

    public function enableModule(Request $request)
    {
        $request->validate(['module' => 'required|string', 'value' => 'required|string']);
        try {
            $domain = getDomain();
            $config = Config::where('domain', $domain)->first() ?? new Config();
            $config->domain = $domain;
            $config->{$request->module} = $request->value === 'true' ? 1 : 0;
            $config->save();
            return response()->json(['success' => true, 'message' => 'Cập nhật thành công']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function updateModuleConfig(Request $request)
    {
        $request->validate(['module' => 'required|string', 'data' => 'required|array']);
        try {
            $domain = getDomain();
            $config = Config::where('domain', $domain)->first() ?? new Config();
            $config->domain = $domain;
            foreach ($request->data as $key => $value) {
                $config->{$key} = $value;
            }
            $config->save();
            return response()->json(['success' => true, 'message' => 'Cập nhật thành công']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function updateKeepOrders(Request $request)
    {
        try {
            $config = Config::first() ?? new Config();
            $text = trim((string)($request->input('keep_orders') ?? ''));
            
            if (!$text) {
                $config->keep_orders = null;
                $config->save();
                return redirect()->back()->with('success', 'Cập nhật thành công!');
            }

            if (preg_match('/\[[\s\S]*\]/', $text, $m)) {
                $parsed = @json_decode($m[0], true);
                if (is_array($parsed)) {
                    $items = array_map(fn($v) => trim((string)$v), $parsed);
                    $items = array_filter($items, fn($v) => $v !== '');
                    if ($items) {
                        $config->keep_orders = json_encode(array_unique($items), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
                        $config->save();
                        return redirect()->back()->with('success', 'Cập nhật thành công!');
                    }
                }
            }

            $items = preg_split('/[\n,;]+/', $text, -1, PREG_SPLIT_NO_EMPTY);
            $items = array_map(fn($v) => trim($v), $items);
            $items = array_filter($items, fn($v) => $v !== '');
            
            $config->keep_orders = json_encode(array_unique($items), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?: null;
            $config->save();

            return redirect()->back()->with('success', 'Cập nhật thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function updateService(Request $request)
    {
        return $this->updateConfig($request, [
            'enable_services'              => 'nullable|boolean',
            'service_allow_report'         => 'nullable|boolean',
            'service_require_login'        => 'nullable|boolean',
            'service_average_time'         => 'nullable|boolean',
            'require_confirm_service'      => 'nullable|boolean',
            'check_duplicate_order_status' => 'nullable|boolean',
            'check_duplicate_order_time'   => 'nullable|integer|min:0|max:99',
        ], [
            'enable_services', 'service_allow_report', 'service_require_login',
            'service_average_time', 'require_confirm_service',
            'check_duplicate_order_status', 'check_duplicate_order_time',
        ]);
    }

    public function updateCloudflare(Request $request)
    {
        return $this->updateConfig($request, [
            'cloudflare_email' => 'nullable|email|max:255',
            'cloudflare_global_key' => 'nullable|string|max:500',
            'cloudflare_account_id' => 'nullable|string|max:255',
            'cloudflare_token' => 'nullable|string|max:500',
            'cloudflare_ip_host' => 'nullable|ip',
        ], [
            'cloudflare_email', 'cloudflare_global_key', 'cloudflare_account_id',
            'cloudflare_token', 'cloudflare_ip_host'
        ]);
    }

    public function uploadLogo(Request $request)
    {
        try {
            $domain = getDomain();
            $config = Config::where('domain', $domain)->first() ?? new Config();
            $config->domain = $domain;
            $logoFields = ['favicon', 'logo', 'logo_square', 'logo_facebook'];
            $uploadedFiles = [];
            $errors = [];
            $fieldsToUpdate = [];
            
            foreach ($logoFields as $field) {
                if ($request->hasFile($field)) {
                    $file = $request->file($field);
                    
                    $validator = Validator::make(
                        [$field => $file],
                        [$field => 'required|image|mimes:jpeg,png,gif,webp|max:5120']
                    );
                    
                    if ($validator->fails()) {
                        $errors[$field] = $validator->errors()->first($field);
                        continue;
                    }
                    
                    try {
                        $oldFilename = $config->$field;
                        if ($oldFilename) {
                            $oldPath = public_path('assets/media/' . $oldFilename);
                            if (file_exists($oldPath)) {
                                @unlink($oldPath);
                            }
                        }
                        
                        $timestamp = time();
                        $filename = $field . '_' . $timestamp . '.' . $file->getClientOriginalExtension();
                        $file->move(public_path('assets/media'), $filename);
                        
                        $fieldsToUpdate[$field] = $filename;
                        $uploadedFiles[$field] = $filename;
                    } catch (\Exception $e) {
                        $errors[$field] = 'Lỗi khi lưu file: ' . $e->getMessage();
                    }
                }
            }
            
            if (!empty($fieldsToUpdate)) {
                $config->update($fieldsToUpdate);
            }
            
            $message = '';
            if (!empty($uploadedFiles)) {
                $fieldNames = implode(', ', array_keys($uploadedFiles));
                $message = "Đã cập nhật thành công: $fieldNames";
            }
            
            if (!empty($errors)) {
                $errorMsg = implode(', ', array_values($errors));
                $message .= ($message ? '. ' : '') . "Lỗi: $errorMsg";
            }
            
            if (empty($uploadedFiles) && !empty($errors)) {
                return response()->json([
                    'message' => $message ?: 'Không có file nào được cập nhật',
                    'uploaded' => [],
                    'errors' => $errors
                ], 422);
            }
            
            return response()->json([
                'message' => $message ?: 'Cập nhật thành công',
                'uploaded' => $uploadedFiles,
                'errors' => $errors
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage(),
                'uploaded' => [],
                'errors' => ['general' => $e->getMessage()]
            ], 500);
        }
    }

    public function updateCurrency(Request $request)
    {
        try {
            if ($request->input('action') === 'fetch') {
                return $this->fetchAndUpdateFromAPI();
            }

            $validated = $request->validate([
                'currencies' => 'required|array',
                'currencies.*' => 'required|array',
                'currencies.*.sync' => 'nullable|boolean',
                'currencies.*.exchange_rate' => 'nullable|numeric|min:0.00000001',
            ]);

            $domain = getDomain();
            $updated = 0;
            $errors = [];

            foreach ($validated['currencies'] as $currencyId => $data) {
                try {
                    if (empty($currencyId)) continue;

                    $currency = Currency::where('domain', $domain)->findOrFail($currencyId);
                    $updateData = [];

                    if (isset($data['sync'])) {
                        $updateData['sync'] = (bool) $data['sync'];
                    }

                    if (isset($data['exchange_rate']) && $data['exchange_rate'] !== null) {
                        $isSynced = $data['sync'] ?? $currency->sync;
                        if (!$isSynced) {
                            $updateData['exchange_rate'] = roundExchangeRate($data['exchange_rate']);
                        }
                    }

                    if (!empty($updateData)) {
                        $currency->update($updateData);
                        $updated++;
                    }
                } catch (\Exception $e) {
                    $errors[$currencyId] = $e->getMessage();
                }
            }

            $message = "Đã cập nhật $updated tiền tệ thành công";
            if (!empty($errors)) {
                $message .= '. ' . count($errors) . ' lỗi xảy ra';
            }

            return $this->sendResponse(true, $message, ['updated' => $updated, 'errors' => $errors], 200, $request);
        } catch (\Exception $e) {
            Log::error('Currency update error: ' . $e->getMessage());
            return $this->sendResponse(false, 'Có lỗi xảy ra: ' . $e->getMessage(), [], 500, $request);
        }
    }

    private function fetchAndUpdateFromAPI()
    {
        try {
            $domain = getDomain();
            $ratesData = fetchCurrencyRates();
            if (!$ratesData) {
                return response()->json(['success' => false, 'message' => 'Không thể lấy dữ liệu tỷ giá từ API'], 500);
            }

            $currencyMetadata = getCurrencyData();
            $updated = $created = 0;

            foreach ($ratesData['conversion_rates'] as $code => $rate) {
                $currency = Currency::where('domain', $domain)->where('code', $code)->first();
                
                if (!$currency) {
                    $currency = Currency::create([
                        'code' => $code,
                        'name' => $currencyMetadata['names'][$code] ?? $code,
                        'symbol' => $currencyMetadata['symbols'][$code] ?? $code,
                        'exchange_rate' => roundExchangeRate($rate),
                        'status' => 1,
                        'symbol_position' => 'before',
                        'sync' => 1,
                        'domain' => $domain
                    ]);
                    $created++;
                } elseif ($currency->sync) {
                    $currency->update(['exchange_rate' => roundExchangeRate($rate)]);
                    $updated++;
                }
            }

            return response()->json([
                'success' => true,
                'message' => "Cập nhật thành công: $updated tiền tệ, tạo mới: $created tiền tệ",
                'data' => ['updated' => $updated, 'created' => $created, 'last_update' => now()->format('Y-m-d H:i:s')]
            ]);
        } catch (\Exception $e) {
            Log::error('Currency fetch rates error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Có lỗi xảy ra khi cập nhật tỷ giá: ' . $e->getMessage()], 500);
        }
    }

    private function fetchCurrencyRates($baseCurrency = 'USD')
    {
        $apiKey = 'efbb7163444e6bb8819e6dbf';
        $url = "https://v6.exchangerate-api.com/v6/{$apiKey}/latest/{$baseCurrency}";

        try {
            $ch = curl_init();
            curl_setopt_array($ch, [
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'
            ]);
            
            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $error = curl_error($ch);
            curl_close($ch);

            if ($error || $httpCode !== 200) {
                Log::error("Currency API Error: {$error} (HTTP: {$httpCode})");
                return false;
            }

            $data = json_decode($response, true);

            if (!$data || !isset($data['result']) || $data['result'] !== 'success') {
                Log::error('Currency API Response Error: ' . ($data['error-type'] ?? 'Unknown error'));
                return false;
            }

            return [
                'success' => true,
                'base_code' => $data['base_code'],
                'time_last_update' => $data['time_last_update_utc'],
                'time_next_update' => $data['time_next_update_utc'],
                'conversion_rates' => $data['conversion_rates']
            ];

        } catch (\Exception $e) {
            Log::error('Currency API Exception: ' . $e->getMessage());
            return false;
        }
    }

    private function roundExchangeRate($rate)
    {
        $rate = (float) $rate;
        
        if ($rate == 1.0) return 1;
        if ($rate < 1) return (float) rtrim(rtrim(number_format($rate, 8, '.', ''), '0'), '.');
        if ($rate < 10) return round($rate, 2);
        if ($rate < 100) return round($rate, 1);
        
        return round($rate, 0);
    }
}
