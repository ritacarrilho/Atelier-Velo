<?php

namespace App\Controller\Admin;

use App\Entity\SubscriberRole;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

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
        ->setPageTitle('index', 'Rôles des Adhérents')
        ->setPageTitle('detail', fn (SubscriberRole $role) => (string) $role)
        ->setPageTitle('edit', fn (SubscriberRole $role) => sprintf($role->getRole()))
    ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('role', 'Rôle'),
            //TODO:change role name
        ];
    }
}
