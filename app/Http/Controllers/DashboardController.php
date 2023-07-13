<?php

namespace App\Http\Controllers;

use App\Models\Dashboards;
use App\Models\UserCurrencyCredit;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Throwable;

class DashboardController extends Controller
{
    public function getDashboardData(Request $request){
        $response = [];

        try{
            $userId = Auth::user()->id;
            $response['user_currency_credit'] = UserCurrencyCredit::where('user_id', $userId)->get();
            $response['transactions_data'] = Dashboards::where('user_id', $userId)->first();
            return response()->json($response, Response::HTTP_OK);
        }catch(Throwable $e){
            $response['error']['general'] = [$e->getMessage()];
            Log::error($e->getMessage());
            return response()->json($response, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
