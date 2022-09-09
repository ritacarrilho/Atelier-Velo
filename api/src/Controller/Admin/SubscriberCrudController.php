<?php

namespace App\Controller\Admin;

use App\Entity\Subscriber;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class SubscriberCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Subscriber::class;
    }

/* Entity fields */
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('first_name', 'Prénom'),
            TextField::new('last_name', 'Nom'),
            TextField::new('phone', 'Téléphone'),
            TextField::new('address', 'Adresse'),
            TextField::new('email', 'Email'),
            AssociationField::new('role', 'Rôle'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
/* change pages title */
    return $crud
        ->setPageTitle('index', 'Adhérents')
        ->setPageTitle('detail', fn (Subscriber $subscriber) => (string) $subscriber)
        ->setPageTitle('edit', fn (Subscriber $subscriber) => sprintf('Editer <b>%s</b>', $subscriber->getFullName()))
    ;
    }
}
