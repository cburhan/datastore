<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('get_token')) {
    function get_token()
    {
        $client = new \GuzzleHttp\Client();

        $url = api()['INTEGRASI_TOKEN'];

        try {
            $response = $client->post($url, [
                'headers' => [
                    'Content-Type' => 'application/text',
                ],
                'body' => json_encode([
                    'username' => 'admin@plnepi.co.id',
                    'password' => 'admin12345',
                ]),
            ]);

            $data = json_decode($response->getBody(), true);
            return $data['access_token'];
        } catch (\Exception $e) {
            log_message('error', 'Error getting token: ' . $e->getMessage());
            return false;
        }
    }
}

if (!function_exists('insert_data')) {
    function insert_data($token, $table_name, $data)
    {
        $client = new \GuzzleHttp\Client();

        $url = api()['INTEGRASI_LOAD'];

        try {
            $response = $client->post($url, [
                'headers' => [
                    'Content-Type' => 'application/text',
                    'Authorization' => 'Bearer ' . $token,
                ],
                'body' => json_encode([
                    'table_name' => $table_name,
                    'data' => $data,
                ]),
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            log_message('error', 'Error loading data: ' . $e->getMessage());
            return false;
        }
    }
}
