<?php

namespace App\Enums;

enum ProductStatus: string {
    case ACTIVE = 'active';
    case ON_HOLD = 'on-hold';
    case EXPIRED = 'expired';
}
