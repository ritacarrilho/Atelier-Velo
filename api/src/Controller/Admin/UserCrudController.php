<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    /* change crud page title */
    public function configureCrud(Crud $crud): Crud
    {
    return $crud
        ->setPageTitle('index', 'Utilisateurs')
        ->setPageTitle('detail', fn (User $user) => (string) $user)
        ->setPageTitle('edit', fn (User $user) => sprintf($user->getUsername()))
    ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('username', 'Username'),
            TextField::new('password', 'Password')->onlyOnForms()->hideWhenUpdating(),
            TextField::new('role', 'Rôle')->onlyOnForms(),
        ];
    }
}