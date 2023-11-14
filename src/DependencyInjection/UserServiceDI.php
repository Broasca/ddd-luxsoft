<?php
/**
 * User: broasca
 * Date: 23.04.2022
 * Time: 18:25
 */

namespace App\DependencyInjection;

use App\Service\UserService;

trait UserServiceDI
{
    protected UserService $userService;

    /** @required */
    public function setUserService(UserService $userService)
    {
        $this->userService = $userService;
    }
}
