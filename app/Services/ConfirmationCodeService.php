<?php

namespace App\Services;

use App\Enums\ConfirmationActions;
use App\Enums\Status;
use App\Library\Token;
use App\Mailables\ConfirmationCodeMessage;
use App\Models\ConfirmationCode;
use Illuminate\Support\Facades\Date;

class ConfirmationCodeService {

    private $confirmationCode = null;

    function create($user, ConfirmationActions $action, $expires_in = 10){
        $expires_at = now()->addMinutes($expires_in);
        $code = $this->generate($user);

        $this->confirmationCode = $user->confirmationCodes()->create([
            'code' => (new Token())->numeric(ConfirmationCode::class),
            'expires_at' => $expires_at,
            'action' => $action
        ]);

        return $this;
    }

    function send($reciever = null){
        $reciever = $reciever ?? $this->confirmationCode->user;
        // notify(ConfirmationCodeMessage::class, [
        //     'code' => $this->confirmationCode->code,
        //     'action' => $this->confirmationCode->action,
        //     'expires_at' => Date::parse($this->confirmationCode->expires_at)->format('jS F Y, h:m A')
        // ])->send($reciever);
    }

    function generate($user) {
        $code = mt_rand(100000, 999999);

        if($user->confirmationCodes()->where([
            'code' => $code,
        ])->exists()) return $this->generate($user);

        return $code;
    }

    function use($user, $code) {
        $user->confirmationCodes()->where('code', $code)->update([
            'status' => Status::VERIFIED
        ]);
    }

}
