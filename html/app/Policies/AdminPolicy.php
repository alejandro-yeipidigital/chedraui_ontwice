<?php

namespace App\Policies;

use App\{Admin};
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct() {
        #
    }

    /**
     * Determine if Current Admin is SuperAdmin
     * @param
     * @return
     */
    public function isSuperAdmin(Admin $admin) : bool
    {
        return $admin->role_id == 1;
    }

    /**
     * Determine if current Admin can access queries
     * @param 
     * @return
     */
    public function accessQueries(Admin $admin) : bool
    {
        return in_array($admin->role_id, [1, 3]);
    }
    
    /**
     * Determine if current Admin can access Log Files
     * @param 
     * @return
     */
    public function accessLogs(Admin $admin) : bool
    {
        return $admin->role_id == 1;
    }   
    
    /**
     * Determine if current Admin can access Promotions
     * @param Admin $admin
     * @return bool
     */
    public function accessPromotions(Admin $admin) : bool
    {
        return $admin->role_id == 1;
    }   

    /**
     * Determine if current Admin can delete a User
     * @param Admin $admin
     * @return bool
     */
    public function deleteUsers(Admin $admin) : bool
    {
        return $admin->role_id == 1;
    }

    /**
     * Determine whether an Admin can visualize Home page dashboard or not
     * @param Admin $admin
     * @return bool
     */
    public function seeDashboard(Admin $admin) : bool
    {
        return $admin->role_id == 1;
    }
}
