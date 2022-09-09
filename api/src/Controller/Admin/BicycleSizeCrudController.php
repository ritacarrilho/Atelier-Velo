<?php

namespace App\Controller\Admin;

use App\Entity\BicycleSize;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class BicycleSizeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return BicycleSize::class;
    }

    /* change crud page title */
    public function configureCrud(Crud $crud): Crud
    {
    return $crud
        ->setPageTitle('index', 'Tailles de Vélo')
        ->setPageTitle('detail', fn (BicycleSize $bike_size) => (string) $bike_size)
        ->setPageTitle('edit', fn (BicycleSize $bike_size) => sprintf($bike_size->getSize()))
    ;
    }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('size', 'Taille'),
        ];
    }
    
}
