<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\KeyValueStore;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use App\Repository\SubscriberRoleRepository;

class UserCrudController extends AbstractCrudController
{
    private $pass_hasher;
    public $userRoleRepo;
    public $roles;

    public function __construct(UserPasswordHasherInterface $passwordHasher, SubscriberRoleRepository $subscriberRoleRepository )
    {
        $this->pass_hasher = $passwordHasher;
        $this->userRoleRepo = $subscriberRoleRepository;
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
        // $roles_array = $this->getUserRoles();
        $user_roles = ['Administrateur' => 'ROLE_ADMIN', 'Utilisateur standard' => 'ROLE_USER'];

        // $roles_repo = $this->userRoleRepo->findAll();

        // if($_GET['subscriberRole'] == $roles_repo[0]){
        //     $user_roles = ['Administrateur' => 'ROLE_ADMIN'];
        // } else {
        //     $user_roles = ['Utilisateur standard' => 'ROLE_USER'];
        // }

        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('username', 'Username'),
            Field::new ('password', 'Password')->setFormType(PasswordType::class)->hideOnIndex(),  
            AssociationField::new('subscriberRole', 'Rôle'),
            ChoiceField::new('roles', 'Autorisation')->setChoices($user_roles)->allowMultipleChoices(),
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

    // Encode password when edit mode
    public function createEditFormBuilder( EntityDto $entityDto, KeyValueStore $formOptions, AdminContext $context ): FormBuilderInterface {
        $plainPassword = $entityDto->getInstance()->getPassword();
        $formBuilder   = parent::createEditFormBuilder( $entityDto, $formOptions, $context );
        $this->addEncodePasswordEventListener( $formBuilder, $plainPassword );

        return $formBuilder;
    }

    // Encode password when new mode
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

    // Create roles array from User roles repository
    // public function getUserRoles(): array {
    //     // $roles = ['Administrateur' =>'ROLE_ADMIN', 'Utilisateur' => 'ROLE_USER'];
    //     $roles_repo = $this->userRoleRepo->findAll();
    //     // dump($roles_repo);
        
    //     for ($i=0; $i < count($roles_repo); $i++) { 
    //         $this->roles .= $roles_repo[$i]->role . ',';
    //     }
        
    //     $array_roles = explode( ',',$this->roles);
    //     // dump($array_roles);
        
    //     if (end($array_roles) == " " || end($array_roles) == "") { 
    //         $last_el = array_pop($array_roles);
    //     }

    //     $roles_array = array_fill_keys($array_roles, 'ROLE_USER');
        
    //     $replacement = array('Administration' => 'ROLE_ADMIN');
    //     $roles_array = array_replace($roles_array, $replacement);
        
    //     // dump($roles_array);
                
    //     // $roles = ['Administrateur' =>'ROLE_ADMIN', 'Utilisateur' => 'ROLE_USER', 'Salarie' => 'ROLE_USER', 'Benevole' => 'ROLE_USER'];

    //     return $roles_array;
    // }
}