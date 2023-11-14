<?php
/**
 * User: broasca
 * Date: 26.06.2023
 * Time: 14:55
 */

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserCrudController extends AbstractCrudController
{
	public static function getEntityFqcn(): string
	{
		return User::class;
	}

	public function configureCrud(Crud $crud): Crud
	{
		return $crud
			->setDefaultSort(['id' => 'DESC'])
			->setPaginatorPageSize(500);
	}

	public function configureFields(string $pageName): iterable
	{
		$id = IdField::new('id');
		$email = TextField::new('email');

		$index = $new = $edit = $detail = [
			$id,
			$email,
		];
		switch ($pageName) {
			case Crud::PAGE_INDEX:
				return $index;
				break;
			case Crud::PAGE_NEW:
				return $new;
				break;
			case Crud::PAGE_EDIT:
				return $edit;
				break;
			case Crud::PAGE_DETAIL:
				return $detail;
				break;
		}
	}
}
