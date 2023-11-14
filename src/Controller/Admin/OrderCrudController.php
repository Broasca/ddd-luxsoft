<?php
/**
 * User: broasca
 * Date: 26.06.2023
 * Time: 14:55
 */

namespace App\Controller\Admin;

use App\Entity\Bid;
use App\Entity\Order;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class OrderCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Order::class;
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
        $deliveryAddress = TextField::new('deliveryAddress');
        $createdAt = DateTimeField::new('createdAt');
        $user = AssociationField::new('user');
        $auction = AssociationField::new('auction');
        $status = ChoiceField::new('status')->setChoices([
            Order::STATUS_PLACED    => Order::STATUS_PLACED,
            Order::STATUS_PAYED     => Order::STATUS_PAYED,
            Order::STATUS_COMPLETED => Order::STATUS_COMPLETED,
        ])->autocomplete();
        $price = IntegerField::new('price');

        $index = $new = $edit = $detail = [
            $deliveryAddress,
            $createdAt,
            $user,
            $auction,
            $status,
            $price,
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
