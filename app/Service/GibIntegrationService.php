<?php

namespace App\Service;

use SoapClient;
use Exception;

class GibIntegrationService
{
    protected $client;

    public function __construct()
    {
        try {
            $this->client = new SoapClient("https://merkeztest.efatura.gov.tr/EFaturaMerkez/services/EFatura?wsdl", [
                'trace' => 1,
                'cache_wsdl' => WSDL_CACHE_NONE,
                'local_cert' => storage_path(env('MALI_MUHUR_PATH')),
                'passphrase' => env('MALI_MUHUR_PASSPHRASE'),
            ]);
        } catch (Exception $e) {
            logger()->error('SOAP Client oluşturulamadı: ' . $e->getMessage());
            throw new Exception('SOAP Client oluşturulamadı. Lütfen ayarları kontrol ediniz.');
        }
    }

    public function fetchInvoices($instanceIdentifier)
    {
        try {
            $params = [
                'instanceIdentifier' => $instanceIdentifier,
            ];

            $response = $this->client->__soapCall('getApplicationResponse', [$params]);

            if (isset($response->applicationResponse)) {
                return simplexml_load_string($response->applicationResponse);
            }

            return null;
        } catch (Exception $e) {
            logger()->error('Fatura çekme hatası: ' . $e->getMessage());
            return null;
        }
    }
}
