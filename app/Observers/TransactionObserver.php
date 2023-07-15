<?php

namespace App\Observers;

use App\Enums\TransactionStatusEnums;
use App\Enums\UserTypeEnums;
use App\Helpers\NotificationHelper;
use App\Models\Notiifications;
use App\Models\Transactions;
use App\Models\Users;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class TransactionObserver
{
    public function created(Transactions $transaction)
    {
        try {
            DB::statement("UPDATE dashboards SET transactions_pending_for_approval = (SELECT count(*) from transactions where transaction_status = 'Pending for Approval' AND user_id = {$transaction->initiator_id})");
            DB::statement("UPDATE dashboards SET transactions_approved = (SELECT count(*) from transactions where transaction_status = 'Approved' AND user_id = {$transaction->initiator_id})");
            DB::statement("UPDATE dashboards SET transactions_rejected = (SELECT count(*) from transactions where transaction_status = 'Rejected' AND user_id = {$transaction->initiator_id})");
            DB::statement("UPDATE dashboards SET transactions_completed = (SELECT count(*) from transactions where transaction_status = 'Completed' AND user_id = {$transaction->initiator_id})");


            $managers = Users::where('user_type_id', UserTypeEnums::MANAGER)->get();
            foreach ($managers as $manager) {
                $notification = new Notiifications();
                $notification->from_user_id = $transaction->initiator_id;
                $notification->to_user_id = $manager->id;
                $notification->title = "New transaction created by {$transaction->initiator->name}";
                $notification->save();
            }
        } catch (Throwable $e) {
            Log::error($e->getMessage());
        }
    }

    public function updated(Transactions $transaction)
    {
        try {
            DB::statement("UPDATE dashboards SET transactions_pending_for_approval = (SELECT count(*) from transactions where transaction_status = 'Pending for Approval' AND user_id = {$transaction->initiator_id})");
            DB::statement("UPDATE dashboards SET transactions_approved = (SELECT count(*) from transactions where transaction_status = 'Approved' AND user_id = {$transaction->initiator_id})");
            DB::statement("UPDATE dashboards SET transactions_rejected = (SELECT count(*) from transactions where transaction_status = 'Rejected' AND user_id = {$transaction->initiator_id})");
            DB::statement("UPDATE dashboards SET transactions_completed = (SELECT count(*) from transactions where transaction_status = 'Completed' AND user_id = {$transaction->initiator_id})");

            switch($transaction->transaction_status){
                case TransactionStatusEnums::APPROVED:
                    NotificationHelper::approvedTransactionNotification($transaction);
                    break;
                case TransactionStatusEnums::REJECTED:
                    NotificationHelper::rejectedTransactionNotification($transaction);
                    break;
                case TransactionStatusEnums::COMPLETED:
                    NotificationHelper::completedTransactionNotification($transaction);
                    break;
                default:
                    break;
            }
        } catch (Throwable $e) {
            Log::error($e->getMessage());
        }
    }
}
