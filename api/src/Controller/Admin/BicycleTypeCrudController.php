<?php

namespace App\Controller\Admin;

use App\Entity\BicycleType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class BicycleTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return BicycleType::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('type', 'Modèle'),
        ];
    }

/* change crud page title */
    public function configureCrud(Crud $crud): Crud
    {
    return $crud
        ->setPageTitle('index', 'Types de Vélo')
        ->setPageTitle('detail', fn (BicycleType $type) => (string) $type)
        ->setPageTitle('edit', fn (BicycleType $type) => sprintf($type->getType()))
    ;
    }
}
