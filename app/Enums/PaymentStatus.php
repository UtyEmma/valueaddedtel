<?php

namespace App\Enums;

enum PaymentStatus:string {

    case PENDING = 'pending';
    case SUCCESS = 'success';
    case REVERSED = 'reversed';
    case FAILED = 'failed';

    static function color($status){
        return match ($status) {
            self::PENDING => 'warning',
            self::SUCCESS => 'success',
            self::REVERSED => 'warning',
            self::FAILED => 'failed',
        };
    }

}
