<?php

namespace App\Repositories;

use App\{User};

class UserRepository 
{
    /**
     * Get all usuers
     */
    public function all ()
    {
        return User::all();
    }

    // /**
    //  * Finds specified user by its id
    //  * @param $user_id
    //  * @return User $user
    //  */
    // public function findUser($user_id) 
    // {
    //     return User::find($user_id);
    // }

    // /**
    //  * Retrives user by its wa_number
    //  * @param $wa_number
    //  * @return User $user
    //  */
    // public function getWANumber($wa_number) 
    // {
    //     return User::whereWaNumber($wa_number)->first();
    // }

    // /**
    //  * Get the users that have completed the register
    //  * @return User $users
    //  */
    // public function getRegisteredUsers() 
    // {
    //     return User::whereRegisterComplete(1)->get();
    // }

    // /**
    //  * Creates a new User
    //  * @param string $wa_number, $country_id
    //  * @return User $user
    //  */
    // public function createUser($wa_number) 
    // {
    //     $user = new User;
    //     $user->name         = $wa_number;
    //     $user->wa_number    = $wa_number;
    //     $user->country_id   = 1;
    //     $user->email        = null;
    //     $user->save();

    //     return $user;
    // }

    // /**
    //  * Get user current promotion active status
    //  * @param $user_id
    //  * @return $user
    //  */
    // public function getUserStatus($user_id) 
    // {
    //     $user = User::find($user_id);

    //     return $user->status()->wherePivot('active', '=', 1)->first();
    // }

    // /**
    //  * Sets previous statuses to zero
    //  * @param $user_id
    //  * @return void
    //  */
    // public function deactivateStatus($user_id) : void 
    // {
    //     $status_id = $this->getUserStatus($user_id)->pivot->status_id;
        
    //     \DB::table('status_users')
    //         ->whereUserId($user_id)
    //         ->whereStatusId($status_id)
    //         ->whereActive(1)
    //         ->update([ 'active' => 0 ]);
    // }

    // /**
    //  * Verify if User's Email is unique
    //  * @param string $email
    //  * @return boolean $unique_email
    //  */ 
    // public function isEmailUnique(string $email) 
    // {
    //     $email_exists = User::whereEmail($email)->first();

    //     return ($email_exists) 
    //             ? false
    //             : true;
    // }

    // /**
    //  * Verify if User's Email is unique
    //  * @param int $user_id
    //  * @param string $email
    //  * @return boolean $unique_email
    //  */ 
    // public function isEmailUniqueUpdate(int $user_id, string $email) 
    // {
    //     $email_exists = User::whereEmail($email)
    //                         ->where('id', '<>', $user_id)
    //                         ->first();

    //     return ($email_exists) 
    //             ? false
    //             : true;
    // }

    // /**
    //  * Update User's Email
    //  * @param $user_id, $email
    //  * @return
    //  */
    // public function storeEmail($user_id, $email) 
    // {
    //     return User::whereId($user_id)
    //                 ->update([ 
    //                             'email' => $email
    //                             ]);
    // }

    // /**
    //  * Update User's name
    //  * @param $user_id, $name
    //  * @return
    //  */
    // public function storeName($user_id, $name) 
    // {
    //     return User::whereId($user_id)
    //                 ->update([ 
    //                             'name' => $name
    //                             ]);
    // }

    // /**
    //  * Update User's middle_name
    //  * @param $user_id, $middle_name
    //  * @return
    //  */
    // public function storeRut($user_id, $rut) 
    // {
    //     return User::whereId($user_id)
    //                 ->update([ 
    //                             'rut' => $rut
    //                             ]);
    // }

    // /**
    //  * Update User's middle_name
    //  * @param $user_id, $middle_name
    //  * @return
    //  */
    // public function storeMiddleName($user_id, $middle_name) 
    // {
    //     return User::whereId($user_id)
    //                 ->update([ 
    //                             'middle_name' => $middle_name
    //                             ]);
    // }

    // /**
    //  * Update User's last_name
    //  * @param $user_id, $last_name
    //  * @return
    //  */
    // public function storeLastName($user_id, $last_name) 
    // {
    //     return User::whereId($user_id)
    //                 ->update([ 
    //                             'last_name' => $last_name
    //                             ]);
    // }

    // /**
    //  * Update User's telephone
    //  * @param $user_id, $telephone
    //  * @return
    //  */
    // public function storeTelephone($user_id, $telephone) 
    // {
    //     return User::whereId($user_id)
    //                 ->update([ 
    //                             'telephone' => $telephone
    //                             ]);
    // }

    // /**
    //  * Set register complete to true
    //  * 
    //  * @param int $user_id
    //  * @return User
    //  */
    // public function confirmRegister (int $user_id)
    // {
    //     return User::whereId($user_id)->update([
    //         'register_complete' => 1
    //     ]);
    // }

    // /**
    //  * Count the users that have completed the register
    //  * @return int $registered_users
    //  */
    // public function countRegisteredUsers () : int
    // {
    //     return User::whereRegisterComplete(1)->count();
    // }

    // /**
    //  * Count all users
    //  * 
    //  * @param none
    //  * @return int $users
    //  */
    // public function countUsers () : int
    // {
    //     return User::count();
    // }
}