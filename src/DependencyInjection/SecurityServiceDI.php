<?php
/**
 * User: broasca
 * Date: 23.04.2022
 * Time: 18:25
 */

namespace App\DependencyInjection;

use App\Service\AdvertiserService;
use App\Service\SecurityService;

trait SecurityServiceDI
{
	protected SecurityService $securityService;

	/** @required */
	public function setSecurityService(SecurityService $securityService)
	{
		$this->securityService = $securityService;
	}
}
