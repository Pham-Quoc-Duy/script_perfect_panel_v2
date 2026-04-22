<?php

namespace App\Library;

use App\Models\Config;

class CloudflareCustom
{
    public $email;
    public $global_key;
    public $account_id;
    public $token;
    public $ip_host;

    public function __construct()
    {
        $config = Config::where('domain', getDomain())->first();
        
        $this->email = $config?->cloudflare_email ?? '';
        $this->global_key = $config?->cloudflare_global_key ?? '';
        $this->account_id = $config?->cloudflare_account_id ?? '';
        $this->token = $config?->cloudflare_token ?? '';
        $this->ip_host = $config?->cloudflare_ip_host ?? '';
    }

    public function profile()
    {
        $url = "https://api.cloudflare.com/client/v4/user";
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $headers = array(
            "X-Auth-Email: " . $this->email,
            "X-Auth-Key: " . $this->global_key,
            "Content-Type: application/json",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $resp = curl_exec($curl);
        curl_close($curl);
        return json_decode($resp, true);
    }

    public function addDomain($domainName)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.cloudflare.com/client/v4/zones',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
            "account": {
                "id": "' . $this->account_id . '"
            },
            "name": "' . $domainName . '",
            "type": "full"
            }',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $this->token,
                'Content-Type: application/json',
                'Cookie: __cflb=0H28vgHxwvgAQtjUGUFqYFDiSDreGJnV1M6FaTYBqaD; __cfruid=358beaec641e06b842f247be1a47c05a8076c644-1714042941'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $result = json_decode($response, true);

        if (isset($result) && $result['success'] == true) {
            $dd = $this->recordDomain($result['result']['id'], $domainName);
            // dd($dd);
            if (count($dd['result']) == 0) {
                $cc = $this->createDns($result['result']['id']);
                $dns_id = $cc['result']['id'] ?? null;
            } else {
                $dns_id = $dd['result'][0]['id'] ?? null;
            }

            return [
                'status' => 'success',
                'message' => 'Thêm tên miền thành công!',
                'data' => [
                    'zone_id' => $result['result']['id'],
                    'zone_name' => $result['result']['name'],
                    'zone_status' => $result['result']['status'],
                    'dns_id' => $dns_id,
                    'nameserver1' => $result['result']['name_servers'][0] ?? null,
                    'nameserver2' => $result['result']['name_servers'][1] ?? null,
                ]
            ];
        } else {
            return [
                'status' => 'error',
                'message' => $result['errors'][0]['message'] ?? "Lỗi không xác định vui lòng thử lại sau!",
                "code" => $result['errors'][0]['code'] ?? null,
                "data" => $result
            ];
        }
    }

    public function deleteDomain($zone_id)
    {


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.cloudflare.com/client/v4/zones/' . $zone_id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'DELETE',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . $this->token,
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $result = json_decode($response, true);
        if (isset($result) && $result['success'] == true) {
            return [
                'status' => 'success',
                'message' => 'Xóa tên miền thành công!',
                'data' => [
                    'zone_id' => $result['result']['id'],
                ]
            ];
        } else {
            return [
                'status' => 'error',
                'message' => $result['errors'][0]['message'] ?? "Lỗi không xác định vui lòng thử lại sau!"
            ];
        }
    }

    public function findDomain($domain_name)
    {
        $url = "https://api.cloudflare.com/client/v4/zones";
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
            "Authorization: Bearer " . $this->token,
            "Content-Type: application/json",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $resp = curl_exec($curl);
        curl_close($curl);
        $data = json_decode($resp, true);
        
        if (!isset($data['result']) || !is_array($data['result'])) {
            return [
                'status' => 'error',
                'message' => 'Failed to fetch zones from Cloudflare',
                'data' => $data
            ];
        }
        
        $d = $domain_name;
        $v = [];
        foreach ($data['result'] as $zone) {
            $id = $zone['id'];
            $name = $zone['name'];
            $check = strpos($name, $d);
            if ($check !== false) {
                $v['zone_id'] = $id;
                $v['zone_name'] = $name;
                $v['zone_status'] = $zone['status'];
                $v['status'] = 'success';
                return $v;
            }
        }
        
        return [
            'status' => 'error',
            'message' => 'Domain not found in Cloudflare zones',
            'searched_domain' => $domain_name
        ];
    }

    /**
     * Get zone ID by domain name
     * This method searches for a domain in Cloudflare and returns its zone_id
     */
    public function getZoneIdByDomain($domain_name)
    {
        try {
            $url = "https://api.cloudflare.com/client/v4/zones";
            $curl = curl_init($url);
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer ' . $this->token,
                    'Content-Type: application/json',
                ),
            ));

            $response = curl_exec($curl);
            curl_close($curl);
            $result = json_decode($response, true);

            if (!isset($result['success']) || !$result['success']) {
                return [
                    'status' => 'error',
                    'message' => $result['errors'][0]['message'] ?? 'Failed to fetch zones from Cloudflare',
                    'data' => $result
                ];
            }

            if (!isset($result['result']) || !is_array($result['result'])) {
                return [
                    'status' => 'error',
                    'message' => 'No zones found in Cloudflare account',
                    'data' => $result
                ];
            }

            // Search for the domain in the zones list
            foreach ($result['result'] as $zone) {
                $zoneName = $zone['name'] ?? '';
                
                // Check if domain matches exactly or is a subdomain
                if ($zoneName === $domain_name || 
                    strpos($domain_name, $zoneName) !== false ||
                    strpos($zoneName, $domain_name) !== false) {
                    
                    return [
                        'status' => 'success',
                        'zone_id' => $zone['id'],
                        'zone_name' => $zone['name'],
                        'zone_status' => $zone['status'],
                        'created_on' => $zone['created_on'] ?? null,
                        'modified_on' => $zone['modified_on'] ?? null,
                        'name_servers' => $zone['name_servers'] ?? [],
                    ];
                }
            }

            return [
                'status' => 'error',
                'message' => 'Domain "' . $domain_name . '" not found in Cloudflare zones',
                'searched_domain' => $domain_name,
                'available_zones' => array_map(function($zone) {
                    return $zone['name'];
                }, $result['result'])
            ];
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => 'Exception while fetching zones: ' . $e->getMessage(),
                'exception' => get_class($e)
            ];
        }
    }

    public function infoDomain($zone_id)
    {
        $url = "https://api.cloudflare.com/client/v4/zones/$zone_id";
        return $this->send($url, "GET");
    }

    public function recordDomain($zone_id, $domain)
    {
        $url = "https://api.cloudflare.com/client/v4/zones/$zone_id/dns_records?search=$domain";
        return $this->send($url, "GET");
    }

    public function dnsRecord($zone_id, $dns_record)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://api.cloudflare.com/client/v4/zones/$zone_id/dns_records/$dns_record");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');


        $headers = array();
        $headers[] = 'X-Auth-Email: ' . $this->email;
        $headers[] = 'X-Auth-Key: ' . $this->global_key;
        $headers[] = 'Content-Type: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        return json_decode($result, true);
        /* $url = "https://api.cloudflare.com/client/v4/zones/$zone_id/dns_records/$dns_record";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
            "X-Auth-Email: " . $this->email,
            "X-Auth-Key: " . $this->global_key,
            "Content-Type: application/json",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $resp = curl_exec($curl);
        curl_close($curl);
        return json_decode($resp, true); */
    }

    public function scanDns($zone_id)
    {

        $url = "https://api.cloudflare.com/client/v4/zones/$zone_id/dns_records/scan";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
            "X-Auth-Email: " . $this->email,
            "X-Auth-Key: " . $this->global_key,
            "Content-Type: application/json",
            "Content-Length: 0",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $resp = curl_exec($curl);
        curl_close($curl);
        return json_decode($resp, true);
    }

    public function createDns($zone_id)
    {
        $url = "https://api.cloudflare.com/client/v4/zones/$zone_id/dns_records";

        $data = [
            "type" => "A",
            "name" => '@',
            "content" => $this->ip_host,
            "ttl" => 1,
            "priority" => 10,
            "proxied" => true
        ];

        return $this->send($url, "POST", $data);
    }

    public function updateDns($zone_id, $dns_record)
    {
        $url = 'https://api.cloudflare.com/client/v4/zones/' . $zone_id .  '/dns_records/' . $dns_record;

        $data = [
            "type" => "A",
            "name" => '@',
            "content" => $this->ip_host,
            "ttl" => 1,
            "priority" => 10,
            "proxied" => true
        ];

        $send = $this->send($url, "PUT", $data);
        return $send;
    }

    public function deleteDns($zone_id, $dns_record)
    {

        $url = "https://api.cloudflare.com/client/v4/zones/$zone_id/dns_records/$dns_record";
        return $this->send($url, "DELETE");
    }

    public function updateSslTls($zone_id)
    {

        $url = 'https://api.cloudflare.com/client/v4/zones/' . $zone_id . '/settings/ssl';
        $data = [
            "value" => "full"
        ];

        return $this->send($url, "PATCH", $data);
    }

    public function send($url, $method = "GET", $data = [])
    {
        $curl = curl_init($url);
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $this->token,
                'X-Auth-Email: ' . $this->email,
                'X-Auth-Key: ' . $this->global_key,
                'Content-Type: application/json',
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response, true);
    }

    /**
     * Check if Cloudflare is properly configured
     */
    public function isConfigured(): bool
    {
        return !empty($this->email) && 
               !empty($this->global_key) && 
               !empty($this->account_id) && 
               !empty($this->token) && 
               !empty($this->ip_host);
    }

    /**
     * Get configuration status with missing fields
     */
    public function getConfigStatus(): array
    {
        $missing = [];
        
        if (empty($this->email)) $missing[] = 'email';
        if (empty($this->global_key)) $missing[] = 'global_key';
        if (empty($this->account_id)) $missing[] = 'account_id';
        if (empty($this->token)) $missing[] = 'token';
        if (empty($this->ip_host)) $missing[] = 'ip_host';
        
        return [
            'is_configured' => empty($missing),
            'missing_fields' => $missing
        ];
    }

    /**
     * Create domain with automatic DNS and IP configuration
     */
    public function createDomainWithAutoConfig($domainName, $customIp = null): array
    {
        try {
            // Use custom IP if provided, otherwise use default
            $ip = $customIp ?? $this->ip_host;
            
            // Add domain to Cloudflare
            $addResult = $this->addDomain($domainName);
            
            if ($addResult['status'] !== 'success') {
                return [
                    'status' => 'error',
                    'message' => $addResult['message'],
                    'code' => $addResult['code'] ?? null
                ];
            }
            
            $data = $addResult['data'];
            $zone_id = $data['zone_id'];
            $dns_id = $data['dns_id'];
            
            // Update DNS record with IP
            if ($dns_id) {
                $this->updateDns($zone_id, $dns_id);
            }
            
            // Update SSL/TLS settings
            $this->updateSslTls($zone_id);
            
            return [
                'status' => 'success',
                'data' => [
                    'zone_id' => $zone_id,
                    'dns_id' => $dns_id,
                    'nameserver1' => $data['nameserver1'],
                    'nameserver2' => $data['nameserver2'],
                    'zone_status' => $data['zone_status'],
                    'created_at' => now()->toIso8601String()
                ]
            ];
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => $e->getMessage(),
                'code' => 'EXCEPTION'
            ];
        }
    }
}

#tips
#step 1: Thêm tên miền
/* $data = Cloudflare::addDomain('luongbinhduong.ga');
print_r($data); */

#step 2: Thông tin tên miền lấy data
// $data = Cloudflare::findDomain();
/* foreach($data['result'] as $v){
    $id = $v['id'];
    $name = $v['name'];
    $d = "shopcodengon.net";
    $check = strpos($name, $d);
    if($check !== false){
        echo $id . "|" . $name;
    }
} */
// $data = Cloudflare::infoDomain('abc3fd07df0d6fc1cf1157e3f0722d8c');

#step 3: Thông tin tên miền lấy data id để sử dụng step 4
// $data = Cloudflare::recordDomain('65d06f72552936b70aae43b2fb0b7098');
// $data = Cloudflare::dnsRecord('ea706bdc19de26348a6d90b32503a06f', 'abc3fd07df0d6fc1cf1157e3f0722d8c');

#step 4: Nhập zone id của tên miền và và id của tên miền lấy từ step 3
// $data = Cloudflare::deleteDns('75288884cd23824e712fe04946639f98', '044c123ed7501712089a9342c72bbb43');

#step 5: Nhập host cho domain site con
// $data = Cloudflare::createDns('75288884cd23824e712fe04946639f98');

#step 6: Cập nhật dns
// $data = Cloudflare::updateDns('65d06f72552936b70aae43b2fb0b7098', '65e9d9c19f37fdb95941178509d40d6a');

/* echo "<pre>";
print_r($data);
echo "</pre>"; */
