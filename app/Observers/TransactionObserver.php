<?php

namespace App\Observers;

use App\Enums\TransactionStatusEnums;
use App\Models\Transactions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class TransactionObserver 
{
    public function created(Transactions $transaction)
    {
        try{
            $pending_for_approval = TransactionStatusEnums::PENDING_FOR_APPROVAL;
            DB::statement("UPDATE dashboards SET transactions_pending_for_approval = (SELECT count(*) from transactions where transaction_status = {$pending_for_approval} AND user_id = {$transaction->initiator_id})");
            $approved = TransactionStatusEnums::APPROVED;
            DB::statement("UPDATE dashboards SET transactions_approved = (SELECT count(*) from transactions where transaction_status = {$approved} AND user_id = {$transaction->initiator_id})");
            $rejected = TransactionStatusEnums::REJECTED;
            DB::statement("UPDATE dashboards SET transactions_rejected = (SELECT count(*) from transactions where transaction_status = {$rejected} AND user_id = {$transaction->initiator_id})");
            $completed = TransactionStatusEnums::COMPLETED;
            DB::statement("UPDATE dashboards SET transactions_completed = (SELECT count(*) from transactions where transaction_status = {$completed} AND user_id = {$transaction->initiator_id})");

        }catch(Throwable $e){
            Log::error($e->getMessage());
        }
        
    }

    public function updated(Transactions $transaction)
    {
        try{
            $pending_for_approval = TransactionStatusEnums::PENDING_FOR_APPROVAL;
            DB::statement("UPDATE dashboards SET transactions_pending_for_approval = (SELECT count(*) from transactions where transaction_status = {$pending_for_approval} AND user_id = {$transaction->initiator_id})");
            // Log::debug("UPDATE dashboards SET transactions_pending_for_approval = (SELECT count(*) from transactions where transaction_status = {$pending_for_approval} AND user_id = {$transaction->initiator_id})")
            $approved = TransactionStatusEnums::APPROVED;
            DB::statement("UPDATE dashboards SET transactions_approved = (SELECT count(*) from transactions where transaction_status = {$approved} AND user_id = {$transaction->initiator_id})");
            $rejected = TransactionStatusEnums::REJECTED;
            DB::statement("UPDATE dashboards SET transactions_rejected = (SELECT count(*) from transactions where transaction_status = {$rejected} AND user_id = {$transaction->initiator_id})");
            $completed = TransactionStatusEnums::COMPLETED;
            DB::statement("UPDATE dashboards SET transactions_completed = (SELECT count(*) from transactions where transaction_status = {$completed} AND user_id = {$transaction->initiator_id})");
        }catch(Throwable $e){
            Log::error($e->getMessage());
        }
    }
}
