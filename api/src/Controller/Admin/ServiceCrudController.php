<?php

namespace App\Controller\Admin;

use App\Entity\Service;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;

class ServiceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Service::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('label', 'Activité'),
            TextField::new('description', 'Description'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
        // Entity label
            ->setEntityLabelInSingular('Activité')
            ->setEntityLabelInPlural('Activités')
        // Pages titles
            ->setPageTitle('index', 'Activités')
            ->setPageTitle('detail', fn (Service $product) => (string) $product)
            ->setPageTitle('edit', fn (Service $category) => sprintf($category->getLabel()))
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
                return $action->setLabel('Ajouter Activité')->addCssClass('btn btn-success');
            })
            ->update(Crud::PAGE_INDEX, Action::DELETE, function (Action $action) {
                return $action->setCssClass('text-danger action-delete');
            })
            ->update(Crud::PAGE_INDEX, Action::EDIT, function (Action $action) {
                return $action->setCssClass('text-warning');
            });
    }
}
