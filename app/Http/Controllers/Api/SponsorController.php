<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
            'amount' => $data['']
        ]);
    }
}