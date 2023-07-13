<?php

namespace App\Helpers;

use App\Models\Dashboards;
use App\Models\LookupCurrencies;
use App\Models\UserCurrencyCredit;

class UserDashboardHelper{
    public static function initUserDashboard($user_id){
        $userDashboard = new Dashboards();
        $userDashboard->user_id = $user_id;
        $userDashboard->save();
    }

    public static function initUserCurrencyCredit($user_id){
        $currencies = LookupCurrencies::all()->toArray();

        foreach($currencies as $currency){
            $creditDetails = new UserCurrencyCredit();
            $creditDetails->user_id = $user_id;
            $creditDetails->currency_id = $currency['id'];
            $creditDetails->currency_id_name = $currency['name'];
            $creditDetails->credit_balance = 0;
            $creditDetails->save();
        }
    }
}
?>