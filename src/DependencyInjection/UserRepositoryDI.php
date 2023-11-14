<?php
/**
 * User: broasca
 * Date: 23.04.2022
 * Time: 18:25
 */

namespace App\DependencyInjection;

use App\Repository\UserRepository;

trait UserRepositoryDI
{
	protected UserRepository $userRepository;

	/** @required */
	public function setUserRepository(UserRepository $userRepository)
	{
		$this->userRepository = $userRepository;
	}
}
