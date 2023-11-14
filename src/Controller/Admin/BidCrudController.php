<?php
/**
 * User: broasca
 * Date: 26.06.2023
 * Time: 14:55
 */

namespace App\Controller\Admin;

use App\Entity\Bid;
use App\Entity\Company;
use App\Entity\Item;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class BidCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Bid::class;
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
        $amount = IntegerField::new('amount');
        $createdAt = DateTimeField::new('createdAt');
        $user = AssociationField::new('user');
        $auction = AssociationField::new('auction');
        $status = ChoiceField::new('status')->setChoices([
            Bid::STATUS_APPROVED     => Bid::STATUS_APPROVED,
            Bid::STATUS_NOT_APPROVED => Bid::STATUS_NOT_APPROVED,
        ])->autocomplete();

        $index = $new = $edit = $detail = [
            $amount,
            $createdAt,
            $user,
            $auction,
            $status,
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
