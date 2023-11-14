<?php
/**
 * User: broasca
 * Date: 23.04.2022
 * Time: 18:25
 */

namespace App\DependencyInjection;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

trait TokenStorageInterfaceDI
{
	protected TokenStorageInterface $tokenStorage;

	/** @required */
	public function setTokenStorageInterface(TokenStorageInterface $tokenStorage)
	{
		$this->tokenStorage = $tokenStorage;
	}
}
