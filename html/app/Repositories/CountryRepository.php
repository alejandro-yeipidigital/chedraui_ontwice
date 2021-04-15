<?php

namespace App\Repositories;

use App\Models\{Account, Country, MessageLog, Temporality, Ticket, User, WhatsappNumber};

class CountryRepository 
{
    /**
     * Finds all countries
     * @return Country $countries
     */
    public function allCountries() {
        return Country::all();
    }

    /**
     * Find a specific country
     * @param int $country_id
     * @return Country $country_id
     */
    public function findCountry(int $country_id) {
        return Country::find($country_id);
    }

    /**
     * Retrive Country by its acronym
     * @param string $acronym
     * @return $country
     */
    public function getCountryByAcronym(string $acronym) {
        return Country::whereAcronym($acronym)->first();
    }

    /**
     * Verify if country account is active
     * @param int $country_id
     * @return bool $active 
     */
    public function isAccountCountryActive($country_id) {
        $country = Country::find($country_id, ['active']);
        return ($country->active == 1) 
                    ? true
                    : false; 
    }

    /**
     * Get registered users for a specific country
     * @param int $country_id
     * @return int $users
     */
    public function usersByCountry(int $country_id) {
        return WhatsappNumber::whereCountryId($country_id)
                                ->whereNotNull('user_id')
                                ->count();

    }

    /**
     * Get registered tickets for a specific country
     * @param int $country_id
     * @return int $tickets
     */
    public function ticketsByCountry(int $country_id) {
        $numbers = WhatsappNumber::whereCountryId($country_id)
                                ->whereNotNull('user_id')
                                ->get(['id'])
                                ->pluck('id');
                                
        return Ticket::whereIn('whatsapp_id', $numbers)
                    ->count();
    }
    
    /**
     * Get amount of messaged delivered or received for
     * a specific country 
     * @param int $country_id
     * @param string $status
     * @return int $messages
     */
    public function messagesByCountry(int $country_id, string $status) {
        $accounts = Account::whereCountryId($country_id)
                            ->get(['id'])
                            ->pluck(['id']);

        return MessageLog::whereIn('account_id', $accounts)
                        ->whereStatus($status)
                        ->count();
    }
}