<?php

namespace App\Library;

use App\Models\Config;

class CpanelCustom
{
    private $cpanel_server;
    private $username_cpanel;
    private $password_cpanel;

    public function __construct()
    {
        $config = Config::where('domain', getDomain())->first();
        
        $this->cpanel_server = $config?->cpanel_server ?? '';
        $this->username_cpanel = $config?->cpanel_username ?? '';
        $this->password_cpanel = $config?->cpanel_password ?? '';
    }

    /**
     * Check if cPanel is properly configured
     */
    public function isConfigured(): bool
    {
        return !empty($this->cpanel_server) && 
               !empty($this->username_cpanel) && 
               !empty($this->password_cpanel);
    }

    /**
     * Get configuration status with missing fields
     */
    public function getConfigStatus(): array
    {
        $missing = [];
        
        if (empty($this->cpanel_server)) $missing[] = 'cpanel_server';
        if (empty($this->username_cpanel)) $missing[] = 'cpanel_username';
        if (empty($this->password_cpanel)) $missing[] = 'cpanel_password';
        
        return [
            'is_configured' => empty($missing),
            'missing_fields' => $missing
        ];
    }

    public function createDomain($domain)
    {
        $url = $this->cpanel_server . "/json-api/cpanel?cpanel_jsonapi_apiversion=2&cpanel_jsonapi_module=Park&cpanel_jsonapi_func=park&domain=$domain";

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $header[0] = "Authorization: Basic " . base64_encode($this->username_cpanel . ":" . $this->password_cpanel) . "\n\r";
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_URL, $url);
        $return = curl_exec($curl);
        curl_close($curl);
        return json_decode($return, true);
    }

    public function deleteDomain($domain)
    {
        $url = $this->cpanel_server . "/json-api/cpanel?cpanel_jsonapi_apiversion=2&cpanel_jsonapi_module=Park&cpanel_jsonapi_func=unpark&domain=$domain";

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $header[0] = "Authorization: Basic " . base64_encode($this->username_cpanel . ":" . $this->password_cpanel) . "\n\r";
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_URL, $url);
        $return = curl_exec($curl);
        curl_close($curl);
        return json_decode($return, true);
    }
}
