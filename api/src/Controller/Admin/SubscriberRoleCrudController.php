<?php

namespace App\Controller\Admin;

use App\Entity\SubscriberRole;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SubscriberRoleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SubscriberRole::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
