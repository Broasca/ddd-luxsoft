<?php
/**
 * User: broasca
 * Date: 26.06.2023
 * Time: 14:55
 */

namespace App\Controller\Admin;

use App\Entity\Company;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CompanyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Company::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->showEntityActionsInlined()
            ->setDefaultSort(['id' => 'DESC'])
            ->setPaginatorPageSize(500);
    }

    public function configureFields(string $pageName): iterable
    {
        $id = IdField::new('id');
        $email = TextField::new('email');
        $name = TextField::new('name');
        $contactNumber = TextField::new('contactNumber');
        $creditCardInfo = TextField::new('creditCardInfo');
        $user = AssociationField::new('user');

        $index = $new = $edit = $detail = [
            $email,
            $name,
            $contactNumber,
            $creditCardInfo,
            $user,
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
