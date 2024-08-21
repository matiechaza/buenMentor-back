<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

final class PrexController
{
    public function initiatePayment(Request $request)
    {
        $clientId = $request->input('clientId');
        $amount = $request->input('amount');

        // Obtener credenciales de API de Prex desde la configuración o variables de entorno
        $apiKey = config('services.prex.api_key');
        $apiSecret = config('services.prex.api_secret');

        // Realizar la solicitud a la API de Prex para procesar el pago
        $response = Http::withBasicAuth($apiKey, $apiSecret)
            ->post('https://api.prex.com/payments', [
                'clientId' => $clientId,
                'amount' => $amount
            ]);

        if ($response->successful() && isset($response->json()['paymentId'])) {
            // Lógica para registrar el pago en el backend del merchant
            $paymentId = $response->json()['paymentId'];
            $this->registerPayment($paymentId);
            return response()->json(['success' => true, 'paymentId' => $paymentId]);
        }

        return response()->json(['success' => false, 'message' => 'Payment failed'], 400);
    }

    private function registerPayment($paymentId)
    {
        // Implementar la lógica para registrar el pago en la base de datos del merchant
        // Ejemplo:
        // $order = new Order();
        // $order->payment_id = $paymentId;
        // $order->status = 'completed';
        // $order->save();
    }
}
