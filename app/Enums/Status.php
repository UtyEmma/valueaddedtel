<?php

namespace App\Enums;


enum Status:string {

    case ACTIVE = 'ACTIVE';
    case INACTIVE = 'INACTIVE';
    case SUSPENDED = 'SUSPENDED';
    case EXPIRING = 'EXPIRING';
    case PENDING = 'PENDING';
    case SHORTLISTED = 'SHORTLISTED';
    case SUBMITTED = 'SUBMITTED';
    case REJECTED = 'REJECTED';
    case SUCCESS = 'SUCCESS';
    case CANCELLED = 'CANCELLED';
    case FAILED = 'FAILED';
    case SCHEDULED = 'SCHEDULED';
    case ACCEPTED = 'ACCEPTED';
    case HIRED = 'HIRED';
    case RECIEVED = 'RECIEVED';
    case DECLINED = 'DECLINED';
    case SUBSCRIBED = 'SUBSCRIBED';
    case UNSUBSCRIBED = 'UNSUBSCRIBED';
    case UNPAID = 'UNPAID';
    case PAID = 'PAID';
    case EXPIRED = 'EXPIRED';
    case DRAFT = 'DRAFT';
    case PUBLISHED = 'PUBLISHED';
    case UNPUBLISHED = 'UNPUBLISHED';

    static function color($status){
        $colors = [
            self::ACTIVE->value => 'success',
            self::INACTIVE->value => 'danger',
            self::EXPIRING->value => 'warning',
            self::PENDING->value => 'warning',
            self::REJECTED->value => 'danger',
            self::CANCELLED->value => 'danger',
            self::FAILED->value => 'danger',
            self::SHORTLISTED->value => 'primary',
            self::SUSPENDED->value => 'warning',
            self::RECIEVED->value => 'info',
            self::HIRED->value => 'success',
            self::DECLINED->value => 'danger',
            self::SUBSCRIBED->value => 'success',
            self::UNSUBSCRIBED->value => 'warning',
            self::DRAFT->value => 'warning',
            self::EXPIRED->value => 'danger',
            self::UNPAID->value => 'danger',
            self::PAID->value => 'success',
            self::SUCCESS->value => 'success',
            self::PUBLISHED->value => 'success',
            self::UNPUBLISHED->value => 'success',
        ];

        return $colors[$status];
    }

    static function get($status){
        return self::tryFrom($status);
    }

}
