<?php
defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

class Snowflake
{

    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https:vl67393.ap-southeast-3.aws.snowflakecomputing.com',
            'headers' => [
                'Authorization' => 'Bearer ' . $this->getAccessToken(),
                'Content-Type' => 'application/json'
            ]
        ]);
    }

    private function getAccessToken()
    {
        // Implementasi untuk mendapatkan token akses
        // Bisa menggunakan metode OAuth, JWT, atau metode lain sesuai konfigurasi Snowflake
        return '<your-access-token>';
    }

    public function insertData($data)
    {
        try {
            $response = $this->client->post('/api/v2/statements', [
                'body' => json_encode([
                    'statement' => 'INSERT INTO your_table (column1, column2) VALUES (?, ?)',
                    'parameters' => $data
                ])
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            return false;
        }
    }
}
