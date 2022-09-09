<?php

namespace App\Controller\Admin;

use App\Entity\Bicycle;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class BicycleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Bicycle::class;
    }

    /* change crud page title */
    public function configureCrud(Crud $crud): Crud
    {
    return $crud
        ->setPageTitle('index', 'Vélos')
        ->setPageTitle('detail', fn (Bicycle $bicycle) => (string) $bicycle)
        ->setPageTitle('edit', fn (Bicycle $bicycle) => sprintf($bicycle->getModel()))
    ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('model', 'Vélo'),
            TextField::new('description', 'Description'),
            IntegerField::new('tires_condition', 'Pneus'),
            IntegerField::new('breaks_condition', 'Freins'),
            IntegerField::new('gears_condition', 'Vitesses'),
            MoneyField::new('price', 'Prix')->setCurrency('EUR'),
            ImageField::new('image', 'Image')
                        ->setBasePath('upload/images')
                        ->setUploadDir('public/upload/images')
                        ->setSortable(false),
            BooleanField::new('disponibility', 'Available'),
            AssociationField::new('category', 'Categorie'),
            AssociationField::new('type', 'Modéle'),
            AssociationField::new('size', 'Taille'),
        ];
    }
}
