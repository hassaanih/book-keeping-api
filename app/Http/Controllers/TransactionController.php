<?php

namespace App\Http\Controllers;

use App\Enums\TransactionStatusEnums;
use App\Enums\UserTypeEnums;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Throwable;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {
        $page = 1;
        $page_size = 10;

        $sort_by = 'created_at';
        $select = '*';

        $sort_order = 'desc';
        $filters = null;
        $response = array_filter($request->all());
        extract(array_filter($request->all()));

        // build query
        // ->where('status', BookingStatus::ACTIVE)
        if(Auth::user()->user_type_id == UserTypeEnums::AGENT){
            $query = Transactions::with('initiator')->with('manager')->where('initiator_id', Auth::user()->id)->orderBy($sort_by, $sort_order);
        }else{
            $query = Transactions::with('initiator')->with('manager')->orderBy($sort_by, $sort_order);
        }

        if ($page_size == -1) {
            $response['data'] = $query->select($select)->get();
            return response()->json($response, Response::HTTP_OK);
        }

        return $query->paginate($page_size, $select, $page);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reqParams = $request->all();
        $response = [];

        $validatorRules = [
            'balance' => 'required',
            'target_currency' => 'required',
            'recieving_currency' => 'required',
        ];

        $validationMessages = [
            'balance.required' => 'Balance is required',
            'target_currency.required' => 'Target Currency is required',
            'recieving_currency.required' => 'Target Currency is required',
        ];

        $validator = Validator::make($reqParams, $validatorRules, $validationMessages);

        if($validator->fails()){
            $response['errors'] = $validator->errors();
            return response()->json($response, Response::HTTP_BAD_REQUEST);
        }

        try{
            $transaction = new Transactions($reqParams);
            $transaction->initiator_id = $request->user()->id;
            $transaction->transaction_status = TransactionStatusEnums::PENDING_FOR_APPROVAL;
            $transaction->otp_for_transaction = rand(100000, 999999);
            $transaction->save();
            $response['transaction'] = $transaction;
            return response()->json($response, Response::HTTP_OK);
        }catch(Throwable $e){
            Log::error($e->getMessage());
            $response['error']['general'] = ['Server Error Please Contact Admin'];
            return response()->json($response, Response::HTTP_INTERNAL_SERVER_ERROR);
        }



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function get($id)
    {
        $response = [];
        try{
            $transaction = Transactions::with('initiator')->find($id);
            if(!$transaction){
                $response['error']['general'] = ['Cannot find the requested Transaction'];
                return response()->json($response, Response::HTTP_BAD_REQUEST);
            }
            $response['transaction'] = $transaction;
            return response()->json($response, Response::HTTP_OK);
        }catch(Throwable $e){
            Log::error($e->getMessage());
            $response['error']['general'] = ['Server Error Please Contact Admin'];
            return response()->json($response, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function findUsingOTP($otp)
    {
        $response = [];
        try{
            $transaction = Transactions::with('initiator')->with('manager')->where('otp_for_transaction', $otp)->first();
            if(!$transaction){
                $response['error']['general'] = ['Cannot find the requested Transaction'];
                return response()->json($response, Response::HTTP_BAD_REQUEST);
            }
            $response['transaction'] = $transaction;
            return response()->json($response, Response::HTTP_OK);
        }catch(Throwable $e){
            Log::error($e->getMessage());
            $response['error']['general'] = ['Server Error Please Contact Admin'];
            return response()->json($response, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function approveTransaction($id, Request $request)
    {
        $response = [];
        
        try{
            $transaction = Transactions::find($id);
            if(!$transaction){
                $response['error']['general'] = ['No transaction found'];
                return response()->json($response, Response::HTTP_BAD_REQUEST);
            }

            $transaction->manager_id = $request->user()->id;
            $transaction->transaction_status = TransactionStatusEnums::APPROVED;
            $transaction->update();
            $response['transaction'] = $transaction;
            return response()->json($response, Response::HTTP_OK);
        }catch(Throwable $e){
            $response['error']['general'] = ['Contact the admin to approve this transaction'];
            Log::error($e->getMessage());
            return response()->json($response, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function completeTransaction($id, Request $request)
    {
        $response = [];
        
        try{
            $transaction = Transactions::find($id);
            if(!$transaction){
                $response['error']['general'] = ['No transaction found'];
                return response()->json($response, Response::HTTP_BAD_REQUEST);
            }

            $transaction->recieved_by_user_id = $request->user()->id;
            $transaction->transaction_status = TransactionStatusEnums::COMPLETED;
            $transaction->otp_for_transaction = rand(100000, 999999);
            $transaction->update();
            $response['transaction'] = $transaction;
            return response()->json($response, Response::HTTP_OK);
        }catch(Throwable $e){
            $response['error']['general'] = ['Contact the admin to approve this transaction'];
            Log::error($e->getMessage());
            return response()->json($response, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $reqParams = $request->all();
        $response = [];

        $validatorRules = [
            'id' => 'required',
            'initiator_id' => 'required',
            'balance' => 'required',
            'contact_number' => 'required',
            'target_currency' => 'required',
            'recieving_currency' => 'required'
        ];

        $validationMessages = [
            'id' => 'Transaction Id is missing',
            'initiator_id.required' => 'Initaitor is required',
            'balance.required' => 'Balance is required',
            'contact_number.required' => 'Contact Number is required.',
            'recieving_currency.required' => 'Currency is required',
            'target_currency.required' => 'Currency is required'
        ];

        $validator = Validator::make($reqParams, $validatorRules, $validationMessages);

        if($validator->fails()){
            $response['errors'] = $validator->errors();
            return response()->json($response, Response::HTTP_BAD_REQUEST);
        }

        try{
            $transaction = Transactions::find($reqParams['id']);
            $transaction->update($reqParams);
            $response['transcation'] = $transaction;
            return response()->json($response, Response::HTTP_OK);
        }catch(Throwable $e){
            Log::error($e->getMessage());
            $response['error']['general'] = ['Server Error Please Contact Admin'];
            return response()->json($response, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function rejectTransaction(Request $request)
    {
        $response = [];
        $reqParams = $request->all();
        
        $validatorRules = [
            'id' => 'required',
            'reason_for_reject' => 'required',
        ];

        $validationMessages = [
            'id' => 'Transaction Id is missing',
            'reason_for_reject.required' => 'Reason is required',
        ];

        $validator = Validator::make($reqParams, $validatorRules, $validationMessages);

        if($validator->fails()){
            $response['errors'] = $validator->errors();
            return response()->json($response, Response::HTTP_BAD_REQUEST);
        }
        
        try{
            $transaction = Transactions::find($reqParams['id']);
            if(!$transaction){
                $response['error']['general'] = ['No transaction found'];
                return response()->json($response, Response::HTTP_BAD_REQUEST);
            }

            $transaction->manager_id = $request->user()->id;
            $transaction->reason_for_reject = $reqParams['reason_for_reject'];
            $transaction->transaction_status = TransactionStatusEnums::REJECTED;
            $transaction->update();
            $response['transaction'] = $transaction;
            return response()->json($response, Response::HTTP_OK);
        }catch(Throwable $e){
            $response['error']['general'] = ['Contact the admin to approve this transaction'];
            Log::error($e->getMessage());
            return response()->json($response, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
