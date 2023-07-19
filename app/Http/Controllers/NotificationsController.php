<?php

namespace App\Http\Controllers;

use App\Models\Notiifications;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Throwable;

class NotificationsController extends Controller
{
    public function markAsRead(Request $request){
        $response = [];

        try{
            Notiifications::where('to_user_id', Auth::user()->id)->update(['is_read' => true]);
            return response()->json([], Response::HTTP_OK);
        }catch(Throwable $e){
            $response['error'] = [$e->getMessage()];
            Log::error($e->getMessage());
            return response()->json($response, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
