<?php

namespace App\Http\Controllers;

use App\Models\LookupCurrencies;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Throwable;

class LookupDataController extends Controller
{
    public function getAllCurrency(Request $request){
        $response = [];

        try{
            $currency = LookupCurrencies::all();
            if(!$currency){
                $response['error']['general'] = ['No currency found'];
                return response()->json($response, Response::HTTP_BAD_REQUEST);
            }

            $response['lookupCurrency'] = $currency;
            return response()->json($response,Response::HTTP_OK);
        }catch(Throwable $e){
            Log::error($e->getMessage());
            $response['error']['general'] = [$e->getMessage()];
            return response()->json($response, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
