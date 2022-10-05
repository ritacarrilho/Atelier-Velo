<?php

namespace App\Controller\Admin;

use App\Entity\Bicycle;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;

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
    // Entity label
        ->setEntityLabelInSingular('Vélo')
        ->setEntityLabelInPlural('Vélos')
    // Pages title
        ->setPageTitle('index', 'Vélo')
        ->setPageTitle('detail', fn (Bicycle $bicycle) => (string) $bicycle)
        ->setPageTitle('edit', fn (Bicycle $bicycle) => sprintf($bicycle->getModel()))
    // Sort order
        ->setDefaultSort(['id' => 'ASC'])
    // Elements per page
        ->setPaginatorPageSize(15)
        ->setPaginatorRangeSize(4);

    }

    /* Define fields to display */ 
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

    /* Change actions */
    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action->setLabel('Ajouter vélo')->addCssClass('btn btn-success');
            })
            ->update(Crud::PAGE_INDEX, Action::DELETE, function (Action $action) {
                return $action->setLabel('Effacer')->setCssClass('text-danger action-delete');
            })
            ->update(Crud::PAGE_INDEX, Action::EDIT, function (Action $action) {
                return $action->setLabel('Éditer')->setCssClass('text-warning');
            })
            ->update(Crud::PAGE_EDIT, Action::SAVE_AND_CONTINUE, function (Action $action) {
                return $action->setLabel('Enregistrer et continuer l\'édition');
            })
            ->update(Crud::PAGE_EDIT, Action::SAVE_AND_RETURN, function (Action $action) {
                return $action->setLabel('Enregistrer');
            });
    }
}