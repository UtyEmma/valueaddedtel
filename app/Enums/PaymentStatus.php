<?php

namespace App\Enums;

enum PaymentStatus:string {

    case PENDING = 'pending';
    case SUCCESS = 'success';
    case REVERSED = 'reversed';
    case FAILED = 'failed';
    case CANCELLED = 'cancelled';

    static function color($status){
        return match ($status) {
            self::PENDING => 'warning',
            self::SUCCESS => 'success',
            self::REVERSED => 'info',
            self::FAILED => 'danger',
            self::CANCELLED => 'danger',
        };
    }

    static function alert($status){
        return match ($status) {
            self::PENDING => 'warning',
            self::SUCCESS => 'success',
            self::REVERSED => 'info',
            self::FAILED => 'error',
            self::CANCELLED => 'error',
        };
    }

    static function title($status) {
        return match($status) {
            self::PENDING => "Purchase in progress",
            self::SUCCESS => 'Purchase Completed',
            self::REVERSED => 'Transaction Reversed',
            self::FAILED => 'Purchase Failed',
            self::CANCELLED => 'Purchase Failed',
        };
    }

    static function message($status) {
        return match($status) {
            self::PENDING => "Your purchase is processing. Please check back later",
            self::SUCCESS => 'Your purchase was completed successfully',
            self::REVERSED => 'The transaction was reversed successfully',
            self::FAILED => 'Your puchase could not be completed at the moment. Please try again later',
            self::CANCELLED => 'Your puchase could not be completed at the moment. Please try again later'
        };
    }

}
