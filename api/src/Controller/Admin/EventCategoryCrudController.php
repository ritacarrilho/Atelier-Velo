<?php

namespace App\Controller\Admin;

use App\Entity\EventCategory;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class EventCategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return EventCategory::class;
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
