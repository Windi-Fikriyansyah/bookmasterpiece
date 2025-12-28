<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


class TripayService
{
    protected static function config()
    {
        return [
            'api_key' => config('services.tripay.api_key'),
            'private_key' => config('services.tripay.private_key'),
            'merchant' => config('services.tripay.merchant_code'),
            'url' => config('services.tripay.base_url'),
        ];
    }

    // GET CHANNEL
    public static function getPaymentChannels($amount)
    {
        $config = self::config();

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $config['api_key']
        ])->get($config['url'] . '/merchant/payment-channel', [
            'amount' => $amount
        ]);

        return collect($response['data'])
            ->where('active', true)
            ->values()
            ->toArray();
    }

    // CREATE INVOICE
    public static function createInvoice(array $data)
    {
        $config = self::config();

        $merchantRef = $data['merchant_ref'];


        $signature = hash_hmac(
            'sha256',
            $config['merchant'] . $merchantRef . $data['amount'],
            $config['private_key']
        );

        $payload = [
            'method'         => $data['method'],
            'merchant_ref'   => $merchantRef,
            'amount'         => $data['amount'],
            'customer_name'  => $data['customer_name'],
            'customer_email' => $data['customer_email'],
            'customer_phone' => $data['customer_phone'],
            'order_items'    => [
                [
                    'sku'      => 'SUBSCRIPTION',
                    'name'     => 'Langganan Book Masterpiece AI',
                    'price'    => $data['amount'],
                    'quantity' => 1
                ]
            ],
            'return_url'     => route('payment.success', ['ref' => $merchantRef]),
            'callback_url' => route('tripay.callback'),
            'signature'   => $signature,
        ];

        $res = Http::withHeaders([
            'Authorization' => 'Bearer ' . $config['api_key']
        ])->post($config['url'] . '/transaction/create', $payload);

        if (!$res->successful()) {
            Log::error('Tripay Create Invoice Error', $res->json());
            throw new \Exception('Gagal membuat invoice Tripay');
        }

        return [
            'reference'    => $res->json('data.reference'),
            'checkout_url' => $res->json('data.checkout_url'),
        ];
    }
}
