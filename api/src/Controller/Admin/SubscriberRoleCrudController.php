<?php

namespace App\Controller\Admin;

use App\Entity\SubscriberRole;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;

class SubscriberRoleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SubscriberRole::class;
    }

    /* change crud page title */
    public function configureCrud(Crud $crud): Crud
    {
    return $crud
        ->setPageTitle('index', 'Rôle des Adhérents')
        ->setPageTitle('detail', fn (SubscriberRole $role) => (string) $role)
        ->setPageTitle('edit', fn (SubscriberRole $role) => sprintf($role->getRole()))
    ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('role', 'Rôle'),
        ];
    }

        /* Change actions */
    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action->setLabel('Ajouter Rôle')->addCssClass('btn btn-success');
            })
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
