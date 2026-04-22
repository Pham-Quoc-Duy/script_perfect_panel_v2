<?php

namespace App\Smm;

class Smm
{
    public $api_url = '';
    public $api_key = '';
    public $format = 'json'; // 'form' or 'json'
    public $timeout = 0;
    public $headers = [];
    public $cookies = '';

    public function order($data)
    {
        return $this->request('add', $data);
    }

    public function status($order_id)
    {
        return $this->request('status', ['order' => $order_id]);
    }

    public function multiStatus($order_ids)
    {
        return $this->request('status', ['orders' => implode(',', (array)$order_ids)]);
    }

    public function services()
    {
        return $this->request('services');
    }

    public function refill($order_id)
    {
        return $this->request('refill', ['order' => $order_id]);
    }

    public function multiRefill($order_ids)
    {
        return $this->request('refill', ['orders' => implode(',', (array)$order_ids)], true);
    }

    public function refillStatus($refill_id)
    {
        return $this->request('refill_status', ['refill' => $refill_id]);
    }

    public function multiRefillStatus($refill_ids)
    {
        return $this->request('refill_status', ['refills' => implode(',', (array)$refill_ids)], true);
    }

    public function cancel($order_ids)
    {
        return $this->request('cancel', ['orders' => implode(',', (array)$order_ids)], true);
    }

    public function balance()
    {
        return $this->request('balance');
    }

    private function request($action, $data = [], $assoc = false)
    {
        $payload = array_merge(['key' => $this->api_key, 'action' => $action], $data);
        $response = $this->connect($payload);
        return json_decode($response, $assoc);
    }

    private function connect($data)
    {
        $ch = curl_init($this->api_url);

        $curlOptions = [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => $this->timeout,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'
        ];

        // Set post fields based on format
        if ($this->format === 'json') {
            $curlOptions[CURLOPT_POSTFIELDS] = json_encode($data);
            $httpHeaders = ['Content-Type: application/json'];
        } else {
            $curlOptions[CURLOPT_POSTFIELDS] = http_build_query($data);
            $httpHeaders = ['Content-Type: application/x-www-form-urlencoded'];
        }

        // Add custom headers
        if (!empty($this->headers)) {
            $httpHeaders = array_merge($httpHeaders, $this->headers);
        }

        // Add cookies if provided
        if (!empty($this->cookies)) {
            $curlOptions[CURLOPT_COOKIE] = $this->cookies;
        }

        $curlOptions[CURLOPT_HTTPHEADER] = $httpHeaders;

        curl_setopt_array($ch, $curlOptions);

        $result = curl_exec($ch);
        $error = curl_errno($ch);

        curl_close($ch);

        if ($error != 0 && empty($result)) {
            return false;
        }

        return $result;
    }
}
