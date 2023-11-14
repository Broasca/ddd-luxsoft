<?php
/**
 * User: broasca
 * Date: 23.04.2022
 * Time: 18:25
 */

namespace App\DependencyInjection;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

trait UserPasswordHasherInterfaceDI
{
	protected UserPasswordHasherInterface $userPasswordHasher;

	/** @required */
	public function setUserPasswordHaserInterface(UserPasswordHasherInterface $userPasswordHasher)
	{
		$this->userPasswordHasher = $userPasswordHasher;
	}
}
