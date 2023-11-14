<?php
/**
 * User: broasca
 * Date: 23.04.2022
 * Time: 18:25
 */

namespace App\DependencyInjection;

use Symfony\Component\HttpFoundation\RequestStack;

trait RequestStackDI
{
	protected RequestStack $requestStack;

	/** @required */
	public function setRequestStack(RequestStack $requestStack)
	{
		$this->requestStack = $requestStack;
	}
}
