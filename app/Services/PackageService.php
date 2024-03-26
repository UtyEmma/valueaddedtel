<?php

namespace App\Services;

use App\Enums\PaymentMethods;
use App\Enums\Services;
use App\Enums\TransactionType;
use App\Models\Packages\Package;
use App\Models\User;
use App\Services\Account\WalletService;
use App\Services\Transactions\TransactionService;

class PackageService {

    function setDefault(User $user){
        $package = Package::isDefault()->first();
        $user->package_id = $package->id;
        $user->save();
        $this->saveHistory($user, $package, $package->fee);
    }

    function saveHistory(User $user, Package $package, $amount){
        $user->packageHistory()->create([
            'package_id' => $package->id,
            'fee' => $package->fee,
            'amount_paid' => $amount,
            'currency_code' => $user->currency?->code
        ]);
    }

    function upgrade(User $user, Package $package){
        $payableFee = $package->fee - $user->package->fee;

        // If the selected package fee is less than the current package fee, then the user cannot upgrade.
        if($package->fee < $user->package->fee) {
            return status(false, 'You cannot upgraded to a package lower than your current package');
        }

        // Create the transaction
        [$status, $message, $transaction] = (new TransactionService)->create([
                            'amount' => $payableFee,
                            'payment_method' => PaymentMethods::WALLET,
                            'narration' => "Upgrade to ".$package->name,
                            'type' => Services::PACKAGE_UPGRADE->value
                        ], TransactionType::DEBIT, $user);

        if(!$status) return status($status, $message);

        // Fulfill the transaction on the user's wallet
        [$status, $message] = (new WalletService)->fulfill($user->wallet, $transaction);
        if(!$status) return status($status, $message);

        $user->package_id = $package->id;
        $user->save();

        // Save the package update history
        $this->saveHistory($user, $package, $payableFee);

        return status(true, "Your subscription package has been upgraded successfully");
    }

}
