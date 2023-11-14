<?php
/**
 * User: broasca
 * Date: 26.06.2023
 * Time: 14:55
 */

namespace App\Controller\Admin;

use App\Entity\Auction;
use App\Entity\Item;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CodeEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AuctionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Auction::class;
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
        $name = TextField::new('name');
        $description = CodeEditorField::new('description')->setNumOfRows(5);
        $initialPrice = IntegerField::new('item.initialPrice');
        $item = AssociationField::new('item');
        $owner = AssociationField::new('owner');
        $status = ChoiceField::new('status')->setChoices([
            Item::STATUS_ACTIVE   => Item::STATUS_ACTIVE,
            Item::STATUS_INACTIVE => Item::STATUS_INACTIVE,
            Item::STATUS_LOCKED   => Item::STATUS_LOCKED,
        ])->autocomplete();
        $endDate = DateTimeField::new('endDate');

        $index = $new = $edit = $detail = [
            $name,
            $description,
            $initialPrice,
            $item,
            $owner,
            $status,
            $endDate
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
