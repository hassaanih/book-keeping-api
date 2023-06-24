<?php

namespace App\Enums;

interface TransactionStatusEnums {
    const PENDING_FOR_APPROVAL = 'Pending for Approval';
    const APPROVED = 'Approved';
    const COMPLETED  = 'Completed';
    const REJECTED = 'Rejected';
}
