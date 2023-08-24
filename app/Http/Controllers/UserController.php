<?php

namespace App\Http\Controllers;

use App\Models\LookupCurrencies;
use App\Models\Notiifications;
use App\Models\User;
use App\Models\UserCurrencyCredit;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Throwable;

class UserController extends Controller
{
    /**
     * Create user API
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try {
            $reqParams = array_filter($request->all());

            $validationMessages = [
                'email.required' => 'Email is required.',
                'email.unique' => 'Email is already taken.',
                'email.regex' => 'Email format is invalid.',
            ];

            $validationRules = [
                'name' => 'required',
                'email' => 'required|unique:users,email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
                'password' => 'required',
            ];

            $validator = Validator::make($reqParams, $validationRules, $validationMessages);
            if ($validator->fails()) {
                $response['error'] = $validator->errors();
                return response()->json($response, Response::HTTP_BAD_REQUEST);
            }

            // create model
            $reqParams['password'] = Hash::make($reqParams['password']);
            $user = Users::create($reqParams);

            // store profile_photo if exist

            $user->save();
            // send response
            $response = [];
            $response['user'] = $user;

            return response()->json($response, Response::HTTP_OK);
        } catch (Throwable $e) {
            Log::error($e);
            return response()->json(['errors' => [$e->getMessage()]], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Create user API
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            $reqParams = array_filter($request->all());

            $validationMessages = [
                'email.required' => 'Email is required.',
                'email.unique' => 'Email is already taken.',
                'email.regex' => 'Email format is invalid.',
            ];

            $validationRules = [
                'id' => 'required',
                'name' => 'required',
                'email' => 'required|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            ];

            $validator = Validator::make($reqParams, $validationRules, $validationMessages);
            if ($validator->fails()) {
                $response['error'] = $validator->errors();
                return response()->json($response, Response::HTTP_BAD_REQUEST);
            }

            // create model
            if(array_key_exists('password', $reqParams)){
                $reqParams['password'] = Hash::make($reqParams['password']);
            }
            $user = Users::find($reqParams['id']);

            // store profile_photo if exist

            $user->update($reqParams);
            // send response
            $response = [];
            $response['user'] = $user;

            return response()->json($response, Response::HTTP_OK);
        } catch (Throwable $e) {
            Log::error($e);
            return response()->json(['errors' => [$e->getMessage()]], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Sign in API
     *
     * @return \Illuminate\Http\Response
     */
    public function signin(Request $request)
    {
        try {
            // TODO :: array_filter replace with our custom array filter created recently in some project
            $reqParams = array_filter($request->all());

            $validationMessages = [
                'email.required' => 'Email is required.',
                'password.required' => 'Password is required.',
            ];

            $validationRules = [
                'email' => 'required',
                'password' => 'required',
            ];

            $validator = Validator::make($reqParams, $validationRules, $validationMessages);

            if ($validator->fails()) {
                $response['error'] = $validator->errors();
                return response()->json($response, Response::HTTP_BAD_REQUEST);
            }

            // validate credentials
            $user = Users::where('email', $reqParams['email'])->first();
            if (!$user || !Hash::check($reqParams['password'], $user->password)) {
                $response['error'] = [
                    'general' => ['Invalid username/password combination'],
                ];
                return response()->json($response, Response::HTTP_BAD_REQUEST);
            }
            
            $response['user'] = $user;
            $access_token = $user->createToken('WEB')->plainTextToken;
            $response['user']['access_token']= $access_token;
            return response()->json($response, Response::HTTP_OK);
            
        } catch (Throwable $e) {
            Log::error($e);
            return response()->json(['general' => [$e->getMessage()]], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Sign out API
     *
     * @return \Illuminate\Http\Response
     */
    public function signout(Request $request)
    {
        try {
            // dd($request->user());
            if ($request->user()) {
                $request->user()->currentAccessToken()->delete();
            }
            return response()->json(null, Response::HTTP_OK);
        } catch (Throwable $e) {
            Log::error($e);
            return response()->json(['errors' => [$e->getMessage()]], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }




    /**
     * Reset passowrd using current password
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function resetPassword(Request $request)
    {
        $response = [];
        $reqParams = $request->all();
        try {
            // validate request
            $validationRules = [
                'code' => 'required',
                'password' => 'required|min:8|max:20',
                'confirm_password' => 'required|same:password',
            ];

            $validationMessages = [
                'code' => 'user not found',
                'password.required' => 'New Password is required.',
                'confirm_password.required' => 'Confirm Password is required.',
            ];

            $validator = Validator::make($reqParams, $validationRules, $validationMessages);

            if ($validator->fails()) {
                $response['error'] = $validator->errors();
                return response()->json($response, Response::HTTP_BAD_REQUEST);
            }

            $user = Users::where('code', $reqParams['code'])->first();
            if (!$user) {
                $response['error'][] = ['User not found'];
                return response()->json($response, Response::HTTP_BAD_REQUEST);
            }

            $user->password = Hash::make($reqParams['password']);
            $user->code = md5(time());
            $user->update();

            return response()->json([], Response::HTTP_OK);
        } catch (Throwable $e) {
            Log::error($e);
            return response()->json(['errors' => [$e->getMessage()]], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function sendEmailForResetPassword(Request $request)
    {
        $response = [];
        $reqParams = $request->all();
        try {
            // validate request
            $validationRules = [
                'email' => 'required',
            ];

            $validationMessages = [
                'email' => 'user not found',
            ];

            $validator = Validator::make($reqParams, $validationRules, $validationMessages);

            if ($validator->fails()) {
                $response['error'] = $validator->errors();
                return response()->json($response, Response::HTTP_BAD_REQUEST);
            }

            $user = Users::where('email', $reqParams['email'])->first();
            if (!$user) {
                $response['error'][] = ['User not found'];
                return response()->json($response, Response::HTTP_BAD_REQUEST);
            }
            $code = md5(time());
            return response()->json([], Response::HTTP_OK);
        } catch (Throwable $e) {
            Log::error($e);
            return response()->json(['errors' => [$e->getMessage()]], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Show all user list
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
        $query = Users::orderBy($sort_by, $sort_order);

        if ($page_size == -1) {
            $response['data'] = $query->select($select)->get();
            return response()->json($response, Response::HTTP_OK);
        }

        return $query->paginate($page_size, $select, $page);
    }

    public function find($id){
        $response = [];

        $user = Users::with('userCurrencyCredit')->find($id);
        if(!$user){
            $response['error']['general'] = ['No User found'];
            return response()->json($response, Response::HTTP_BAD_REQUEST);
        } 
        $response['user'] = $user;
        return response()->json($response, Response::HTTP_OK);
    }

    public function addCredit(Request $request){
        $response = [];

        $reqParams = $request->json()->all();

        $validationRules = [
            'id' => 'required',
            'credit_balance' => 'required',
            'currency_id' => 'required'
        ];

        $validationMessages = [
            'id.required' => 'user not found',
            'credit_balance.required' => 'Credit Balance is required',
            'currency_id.required' => 'Currency is required'
        ];

        $validator = Validator::make($reqParams, $validationRules, $validationMessages);

        if ($validator->fails()) {
            $response['error'] = $validator->errors();
            return response()->json($response, Response::HTTP_BAD_REQUEST);
        }

        try{
            $currency = LookupCurrencies::where('id', $reqParams['currency_id'])->first();
            $creditBalance = UserCurrencyCredit::where('user_id', $reqParams['id'])->where('currency_id', $reqParams['currency_id'])->first();
            if(!$creditBalance){
                $response['error']['general'] = ['No Currency Credit found'];
                return response()->json($response, Response::HTTP_BAD_REQUEST);
            }
            $creditBalance->currency_id_name = $currency->name . ' ' . $currency->code;
            $creditBalance->credit_balance = floatval($creditBalance->credit_balance) + floatval($reqParams['credit_balance']);
            $creditBalance->update();
            $response['credit_balance'] = $creditBalance;
            return response()->json($response, Response::HTTP_OK);
        }catch(Throwable $e){
            Log::error($e->getMessage());
            $response['error']['general'] = $e->getMessage();
            return response()->json($response, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getNotification(Request $request){
        $response = [];

        try{
            $notification = Notiifications::where('to_user_id', Auth::user()->id)->where('is_read', false)->orderBy('created_at', 'desc')->get();
            $response['notification'] = $notification;
            return response()->json($response, Response::HTTP_OK);
        }catch(Throwable $e){
            Log::error($e->getMessage());
            return response()->json(['error'=>'Server error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
