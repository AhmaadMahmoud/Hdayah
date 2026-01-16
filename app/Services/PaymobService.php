<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class PaymobService
{
    private string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = rtrim(config('services.paymob.base_url', 'https://accept.paymob.com'), '/');
    }

    public function authenticate(): string
    {
        $response = Http::acceptJson()->post($this->baseUrl . '/api/auth/tokens', [
            'api_key' => config('services.paymob.api_key'),
        ])->throw();

        return $response->json('token');
    }

    public function createOrder(int $amountCents, string $name, array $metadata = [], array $shippingData = []): int
    {
        $token = $this->authenticate();

        $response = Http::acceptJson()->post($this->baseUrl . '/api/ecommerce/orders', [
            'auth_token' => $token,
            'delivery_needed' => 'false',
            'amount_cents' => $amountCents,
            'currency' => 'EGP',
            'items' => [
                [
                    'name' => $name,
                    'amount_cents' => $amountCents,
                    'quantity' => 1,
                ],
            ],
            'merchant_order_id' => $metadata['merchant_order_id'] ?? Str::uuid()->toString(),
            'shipping_data' => $shippingData ?: ($metadata['shipping_data'] ?? []),
            'metadata' => $metadata,
        ])->throw();

        return (int) $response->json('id');
    }

    public function createPaymentKey(int $amountCents, int $orderId, array $billingData, ?int $integrationId = null): string
    {
        $token = $this->authenticate();

        $response = Http::acceptJson()->post($this->baseUrl . '/api/acceptance/payment_keys', [
            'auth_token' => $token,
            'amount_cents' => $amountCents,
            'expiration' => 3600,
            'order_id' => $orderId,
            'currency' => 'EGP',
            'integration_id' => $integrationId ?? config('services.paymob.integration_id_card'),
            'billing_data' => $billingData,
        ])->throw();

        return $response->json('token');
    }

    public function iframeUrl(string $paymentKey): string
    {
        $iframeId = config('services.paymob.iframe_id');

        return $this->baseUrl . '/api/acceptance/iframes/' . $iframeId . '?payment_token=' . $paymentKey;
    }

    public function createCashCollection(int $amountCents, int $orderId, array $billingData, ?int $integrationId = null): array
    {
        $paymentKey = $this->createPaymentKey(
            $amountCents,
            $orderId,
            $billingData,
            $integrationId ?? config('services.paymob.integration_id_cash')
        );

        $response = Http::acceptJson()->post($this->baseUrl . '/api/acceptance/payments/pay', [
            'source' => [
                'identifier' => 'cash',
                'subtype' => 'CASH',
            ],
            'payment_token' => $paymentKey,
        ])->throw();

        return [
            'id' => $response->json('id'),
            'pending' => $response->json('pending'),
            'message' => $response->json('data.message') ?? 'تم إنشاء طلب الدفع كاش، المرجو متابعة الطلب.',
        ];
    }
}
