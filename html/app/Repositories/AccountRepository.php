<?php

namespace App\Repositories;

use App\Models\{Account};

class AccountRepository 
{
    /**
     * Find specific account
     * @param $account_id
     * @return Account $account
     */
    public function findAccount($account_id) {
        return Account::find($account_id);
    }

    /**
     * Retrieve the required columns to send WA messages
     * @param string $acronym
     */
    public function getAccountKeys($wa_number) {
        return Account::whereWaNumber($wa_number)->get(['id', 'country_id', 'wa_number', 'account_sid', 'token']);
    }

    /**
     * Get whatsapp numbers assigned to the specified country
     * @param int $country_id
     * @return array $numbers
     */
    public function getNumbersByCountry(int $country_id) {
        return Account::whereCountryId($country_id)->get(['id', 'country_id', 'wa_number', 'active']);
    }

    /**
     * Switch Account Active status
     * @param int $account_id
     * @param bool $status
     * @return void
     */
    public function switchActiveAccount(int $account_id, bool $status) : void {
        Account::whereId($account_id)
                ->update([
                            'active' => $status 
                        ]);
    }

    /**
     * Verify if account is active or not
     * @param int $account_id
     * @return bool $active
     */
    public function isAccountActive($account_id) : bool {
        $account = Account::find($account_id, ['active']);
        return ($account->active == 1) 
                    ? true
                    : false; 
    }
}