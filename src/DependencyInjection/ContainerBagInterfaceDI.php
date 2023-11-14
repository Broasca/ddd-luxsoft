<?php
/**
 * User: broasca
 * Date: 29.04.2022
 * Time: 12:27
 */

namespace App\DependencyInjection;

use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

trait ContainerBagInterfaceDI
{
	protected ContainerBagInterface $containerBag;

	/** @required */
	public function setContainerBagInterface(ContainerBagInterface $containerBag)
	{
		$this->containerBag = $containerBag;
	}
}
