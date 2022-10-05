<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;

use EasyCorp\Bundle\EasyAdminBundle\Config\KeyValueStore;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class UserCrudController extends AbstractCrudController
{
    private $pass_hasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->pass_hasher = $passwordHasher;
    }

    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    /* change crud page title */
    public function configureCrud(Crud $crud): Crud
    {
    return $crud
    // Entity label
        ->setEntityLabelInSingular('Utilisateur')
        ->setEntityLabelInPlural('Utilisateurs')
    // Pgaes titles
        ->setPageTitle('index', 'Utilisateurs')
        ->setPageTitle('detail', fn (User $user) => (string) $user)
        ->setPageTitle('edit', fn (User $user) => sprintf($user->getUsername()))
    // Sort order
        ->setDefaultSort(['id' => 'ASC'])
    // Elements per page
        ->setPaginatorPageSize(10)
        ->setPaginatorRangeSize(4)
    // Permition
        ->setEntityPermission('ROLE_ADMIN');
    }

    public function configureFields(string $pageName): iterable
    {
        $roles = ['Administrateur' =>'ROLE_ADMIN', 'Utilisateur' => 'ROLE_USER'];

        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('username', 'Username'),
            Field::new ('password', 'Password')->setFormType(PasswordType::class)->hideOnIndex(),        
            // ArrayField::new('roles', 'Rôle') 
            //     ->setHelp('<h5>Rôles Disponibles</h5> <ul><li>Administration: ROLE_ADMIN</li><li>Bénevole et Salarié: ROLE_USER</li><ul>'),
            ChoiceField::new('roles')->setChoices($roles)->allowMultipleChoices(),
        ];
    }

    /* Change actions */
    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action->setLabel('Ajouter Utilisateur')->addCssClass('btn btn-success');
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
            })
            ->setPermission(Action::DELETE, 'ROLE_ADMIN');
    }

    // Encode password
    // public function createEditFormBuilder( EntityDto $entityDto, KeyValueStore $formOptions, AdminContext $context ): FormBuilderInterface {
    //     $plainPassword = $entityDto->getInstance()->getPassword();
    //     $formBuilder   = parent::createEditFormBuilder( $entityDto, $formOptions, $context );
    //     $this->addEncodePasswordEventListener( $formBuilder, $plainPassword );

    //     return $formBuilder;
    // }

    public function createNewFormBuilder( EntityDto $entityDto, KeyValueStore $formOptions, AdminContext $context ): FormBuilderInterface {
        $formBuilder = parent::createNewFormBuilder( $entityDto, $formOptions, $context );
        $this->addEncodePasswordEventListener( $formBuilder );

        return $formBuilder;
    }

    // Encode password Event Listener
    protected function addEncodePasswordEventListener( FormBuilderInterface $formBuilder, $plainPassword = null ): void {
        $formBuilder->addEventListener( FormEvents::SUBMIT, function ( FormEvent $event ) use ( $plainPassword ) {

            /** @var User $user */
            $user = $event->getData();

            if ( $user->getPassword() !== $plainPassword ) {
                $user->setPassword( $this->pass_hasher->hashPassword( $user, $user->getPassword() ) );
            }
        });
    }
}