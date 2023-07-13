<?php

namespace App\Observers;

use App\Helpers\UserDashboardHelper;
use App\Models\Users;
use Illuminate\Support\Facades\Log;
use Throwable;

class UserObserver
{
    public function created(Users $user)
    {
        try{
            Log::debug($user->id);
            UserDashboardHelper::initUserDashboard($user->id);
            UserDashboardHelper::initUserCurrencyCredit($user->id);
        }catch(Throwable $e){
            Log::error($e->getMessage());
        }
        
    }

    public function updated(Users $user)
    {
        try{

        }catch(Throwable $e){
            Log::error($e->getMessage());
        }
    }
}
