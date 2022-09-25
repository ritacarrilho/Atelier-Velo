<?php

namespace App\Controller\Admin;

use App\Entity\BicycleSize;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;

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

    // public function configureActions(Actions $actions): Actions
    // {
    //     return $actions
    //         ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
    //             return $action->setLabel('Ajouter taille');
    //         })
    //         // ->update(Crud::PAGE_INDEX, Action::DELETE, function (Action $action) {
    //         //     return $action->setIcon('fa fa-trash text-danger')->setLabel(false)->setCssClass('btn btn-outline-primary');
    //         // })
    //         // ->update(Crud::PAGE_INDEX, Action::EDIT, function (Action $action) {
    //         //     return $action->setIcon('fa fa-edit text-warning')->setLabel(false)->setCssClass('btn btn-outline-warning');

    //         ->update(Crud::PAGE_INDEX, Action::DELETE, function (Action $action) {
    //             return $action->setLabel('Effacer')->setCssClass('text-danger');
    //         })
    //         ->update(Crud::PAGE_INDEX, Action::EDIT, function (Action $action) {
    //             return $action->setLabel('Éditer')->setCssClass('text-warning');
    //         })
    //         ->update(Crud::PAGE_EDIT, Action::SAVE_AND_CONTINUE, function (Action $action) {
    //             return $action->setLabel('Enregistrer et continuer l\'édition');
    //         })
    //         ->update(Crud::PAGE_EDIT, Action::SAVE_AND_RETURN, function (Action $action) {
    //             return $action->setLabel('Enregistrer');
    //         });
    // }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action->setLabel('Ajouter taille')->addCssClass('btn btn-success');
            })
            // ->update(Crud::PAGE_INDEX, Action::DELETE, function (Action $action) {
            //     return $action->setIcon('fa fa-trash')->setLabel(false)->setCssClass('btn btn-ganger');
            // })
            // ->update(Crud::PAGE_INDEX, Action::EDIT, function (Action $action) {
            //     return $action->setIcon('fa fa-edit')->setLabel(false)->addCssClass('btn btn-warning');
            ->update(Crud::PAGE_INDEX, Action::DELETE, function (Action $action) {
                return $action->setLabel('Effacer')->setCssClass('text-danger');
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
