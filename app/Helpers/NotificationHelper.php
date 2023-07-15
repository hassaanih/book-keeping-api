<?php

namespace App\Helpers;

use App\Models\Dashboards;
use App\Models\LookupCurrencies;
use App\Models\Notiifications;
use App\Models\UserCurrencyCredit;

class NotificationHelper{
    public static function rejectedTransactionNotification($transaction){
        $notification = new Notiifications();
        $notification->to_user_id = $transaction->initiator_id;
        $notification->from_user_id = $transaction->manager_id;
        $notification->title = "Your transaction has been rejected by your corresponding manager {$transaction->manager->name}";
        $notification->save();
    }

    public static function approvedTransactionNotification($transaction){
        $notification = new Notiifications();
        $notification->to_user_id = $transaction->initiator_id;
        $notification->from_user_id = $transaction->manager_id;
        $notification->title = "Your transaction has been approved by your corresponding manager {$transaction->manager->name}";
        $notification->save();
    }

    public static function completedTransactionNotification($transaction){
        $notification = new Notiifications();
        $notification->from_user_id = $transaction->initiator_id;
        $notification->to_user_id = $transaction->manager_id;
        $notification->title = "Your approved transaction has been completed {$transaction->initiator->name}";
        $notification->save();
    }
}
?>