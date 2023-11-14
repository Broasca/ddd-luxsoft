<?php
/**
 * User: broasca
 * Date: 26.06.2023
 * Time: 14:55
 */

namespace App\Controller\Admin;

use App\Entity\Item;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CodeEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ItemCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Item::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setDefaultSort(['id' => 'DESC'])
            ->showEntityActionsInlined()
            ->setPaginatorPageSize(500);
    }

    public function configureFields(string $pageName): iterable
    {
        $id = IdField::new('id');
        $name = TextField::new('name');
        $description = CodeEditorField::new('description')->setNumOfRows(5);
        $category = ChoiceField::new('category')->setChoices([
            "Category 1" => "Category 1",
            "Category 2" => "Category 2",
            "Category 3" => "Category 3",
        ])->autocomplete();
        $initialPrice = IntegerField::new('initialPrice');
        $user = AssociationField::new('user');
        $status = ChoiceField::new('status')->setChoices([
            Item::STATUS_ACTIVE   => Item::STATUS_ACTIVE,
            Item::STATUS_INACTIVE => Item::STATUS_INACTIVE,
            Item::STATUS_LOCKED   => Item::STATUS_LOCKED,
        ])->autocomplete();

        $index = $new = $edit = $detail = [
            $name,
            $description,
            $category,
            $initialPrice,
            $user,
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
