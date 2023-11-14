<?php
/**
 * User: broasca
 * Date: 23.04.2022
 * Time: 18:25
 */

namespace App\DependencyInjection;


use EasyCorp\Bundle\EasyAdminBundle\Orm\EntityRepository;

trait EntityRepositoryDI
{
	protected EntityRepository $entityRepository;

	/** @required */
	public function setEntityRepository(EntityRepository $entityRepository)
	{
		$this->entityRepository = $entityRepository;
	}
}
