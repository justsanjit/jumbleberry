<?php

namespace App\Enums;

enum ApprovalStatus: string {
    case APPROVED = 'approved';
    case REJECTED = 'rejected';
    case PENDING = 'pending';
}
