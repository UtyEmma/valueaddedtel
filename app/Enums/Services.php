<?php

namespace App\Enums;

enum Services:string {

    case AIRTIME = 'airtime';
    case DEPOSIT = 'deposit';
    case WITHDRAWAL = 'withdrawal';
    case VIRTUAL_ACCOUNT = 'virtual_account';
    case INTERNATIONAL_AIRTIME = 'intl_airtime';
    case RECHARGE_PINS = 'recharge_pins';
    case SME_DATA = 'cug_data';
    case INTERNET_DATA = 'internet_data';
    case SMILE = 'smile';
    case SPECTRANET = 'spectranet';
    case DSTV = 'dstv';
    case GOTV = 'gotv';
    case STARTIMES = 'startimes';
    case SHOWMAX = 'showmax';
    case ELECTRICITY = 'electricity';
    case EDUCATION = 'education';

}
