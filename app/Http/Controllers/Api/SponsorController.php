<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Sponsored;
use Illuminate\Http\Request;
use Braintree\Gateway;

class SponsorController extends Controller
{
    public function token(Request $request, Gateway $gateway)
    {
        $token = $gateway->clientToken()->generate();
        $data = [
            'token' => $token
        ];
        return response()->json($data, 200);
    }

    public function transaction(Request $request, Gateway $gateway)
    {
        $data = $request->all();


        $result = $gateway->transaction()->sale([
            'amount' => '10.00',
            'paymentMethodNonce' => $request->token,
            'options' => [
                'submitForSettlement' => true,
            ]
        ]);

        if ($result->success) {
            $data = [
                'success' => true,
                'message' => 'Transazione avvenuta !'
            ];
            return response()->json($data, 200);
        } else {
            $data = [
                'success' => false,
                'message' => "Ops! c'è stato un errore nel Pagamento"
            ];
            return response()->json($data, 401);
        }
    }
}