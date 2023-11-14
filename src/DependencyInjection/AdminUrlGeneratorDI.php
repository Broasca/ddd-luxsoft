<?php
/**
 * User: broasca
 * Date: 31.07.2021
 * Time: 23:49
 */

namespace App\DependencyInjection;

use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;

trait AdminUrlGeneratorDI
{
	/**
	 * @var AdminUrlGenerator
	 */
	protected $adminUrlGenerator;

	/**
	 * @required
	 * @param AdminUrlGenerator $adminUrlGenerator
	 */
	public function setAdminUrlGenerator(AdminUrlGenerator $adminUrlGenerator)
	{
		$this->adminUrlGenerator = $adminUrlGenerator;
	}
}
