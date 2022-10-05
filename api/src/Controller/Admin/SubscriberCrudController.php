<?php

namespace App\Controller\Admin;

use App\Entity\Subscriber;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;

class SubscriberCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Subscriber::class;
    }

/* Entity fields */
    public function configureFields(string $pageName): iterable
    {
        $roles = [
            'User'   => 'ROLE_USER',
            'Admin'  => 'ROLE_ADMIN'
        ];
        
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('first_name', 'Prénom'),
            TextField::new('last_name', 'Nom'),
            TelephoneField::new('phone', 'Téléphone'),
            TextField::new('address', 'Adresse'),
            EmailField::new('email', 'Email'),
            AssociationField::new('role', 'Rôle'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
/* change crud - pages title, entity display name */
    return $crud
    // Entity Label
        ->setEntityLabelInSingular('Adhérent')
        ->setEntityLabelInPlural('Adhérents')
    // Pages titles
        ->setPageTitle('index', 'Adhérents')
        ->setPageTitle('detail', fn (Subscriber $subscriber) => (string) $subscriber)
        ->setPageTitle('new', 'Ajouter Adhérent')
        ->setPageTitle('edit', fn (Subscriber $subscriber) => sprintf('Editer <b>%s</b>', $subscriber->getFullName()))
    // Sort order
        ->setDefaultSort(['id' => 'ASC'])
    // Elements per page
        ->setPaginatorPageSize(10)
        ->setPaginatorRangeSize(4);
    }

    /* Change actions */
    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action->setLabel('Ajouter Adhérent')->addCssClass('btn btn-success');
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
            ->update(Crud::PAGE_NEW, Action::SAVE_AND_RETURN, function (Action $action) {
                return $action->setLabel('Enregistrer');
            });
    }
}
