<?php

namespace App\DataFixtures;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\Bicycle;
use App\Entity\BicycleType;
use App\Entity\BicycleSize;
use App\Entity\EventCategory;
use App\Entity\ProductCategory;
use App\Entity\Event;
use App\Entity\User;
use App\Entity\Product;
use App\Entity\Service;
use App\Entity\Subscriber;
use App\Entity\SubscriberRole;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
/**
 * @var
 */
    private $pass_hasher;
    public $evts;
    public $category;
    public $types;
    public $sizes;
    public $role;
    public $subscribers_nb;
    public $employee_nb;
    public $services;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->pass_hasher = $passwordHasher;
        $this->evts = ["Formation de mécanique", "Activités", "Balades"];
        $this->category = ["Vélo", "Freins", "Poignés", "Pneus", "Antivol", "Chaine", "Selle"];
        $this->types = ["Vélo Ville", "Vélo Route", "VTT"];
        $this->sizes = ["Adulte", "Enfant"];
        $this->role = ["Administration", "Bénévole", "Salarié", "Adhérent"];
        $this->subscribers_nb = 20;
        $this->employee_nb = 5;
        $this->services = ['Vélo école', 'Marquage bicycode', 'Animations', 'Formations mécaniques', 'Récuperation de vélos', 'Actions de sensibilisation'];
    }

/* Load manager - load data into tables */
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('en_EN'); 

        $this->loadProductsCategory($manager);
        $this->loadProduct($manager, $faker);
        $this->loadBicycleType($manager);
        $this->loadBicycleSize($manager);
        $this->loadBicycle($manager, $faker);
        $this->loadEventCategory($manager);
        $this->loadEvent($manager, $faker);
        $this->loadSubscriberRole($manager);
        $this->loadSubscriber($manager, $faker);
        $this->loadUser($manager, $faker);
        $this->loadServices($manager, $faker);

        $manager->flush();
    }

/* PRODUCT CATEGORY */
    public function loadProductsCategory($manager)
    {
        for($i=0; $i < count($this->category); $i++) {
            $prod_category = new ProductCategory();
            $prod_category->setLabel($this->category[$i]);
                    
            $manager->persist($prod_category); // generate an object, keep it in memory in a generic array
        
            $this->addReference('prod_category-' . $i, $prod_category);
        }
    }

/* PRODUCT */
    public function loadProduct($manager, $faker)
    {
    $prod_nb = 30;

        for($i=0; $i < $prod_nb; $i++) {
            $product = new Product();
            $product->setModel( $faker->word( $nb = 3) )
                    ->setDescription( $faker->text($maxNbChars = 60) )  
                    ->setPrice( rand(0, 1000) / 10 ) 
                    ->setImage( $faker->imageUrl($width = 640, $height = 480) ) 
                    ->setCategoryId( $this->getReference(('prod_category-'. rand(1, (count($this->category)-1)))) ); 

            $manager->persist($product);
        }
    }

/* BICYCLE TYPE */
    public function loadBicycleType($manager)
    {
        for($i=0; $i < count($this->types); $i++) {
            $bike_type = new BicycleType();
            $bike_type->setType($this->types[$i]);
    
            $manager->persist($bike_type); 
        
            $this->addReference('bicycle_type-' . ($i+1), $bike_type);
        }
    }

/* BICYCLE SYZE */
    public function loadBicycleSize($manager)
    {
        for($i=0; $i < count($this->sizes); $i++) {
            $bike_type = new BicycleSize();
            $bike_type->setSize($this->sizes[$i]);
    
            $manager->persist($bike_type); 
        
            $this->addReference('bicycle_size-' . ($i+1), $bike_type);
        }
    }

/* BICYCLE */
    public function loadBicycle($manager, $faker)
    {
    $bike_nb = 10;

        for($i=0; $i < $bike_nb; $i++) {
            $bicycle = new Bicycle();
            $bicycle->setModel( $faker->word( $nb = 3) )
                    ->setDescription( $faker->text($maxNbChars = 60) )
                    ->setTiresCondition( rand(1, 5) )  
                    ->setBreaksCondition( rand(1, 5) )  
                    ->setGearsCondition( rand(1, 5) )  
                    ->setPrice( rand(300, 1000) / 10 ) 
                    ->setDisponibility( rand(0, 1) )
                    ->setImage( $faker->imageUrl($width = 640, $height = 480) ) 
                    ->setCategory( $this->getReference(('prod_category-'. 0 ))) 
                    ->setType( $this->getReference(('bicycle_type-'. rand(1, count($this->types) )))) 
                    ->setSize( $this->getReference(('bicycle_size-'. rand(1, count($this->sizes)) ))); 


            $manager->persist($bicycle);
        }
    }

/* EVENT CATEGORY */
    public function loadEventCategory($manager)
    {

        for($i=0; $i < count($this->evts); $i++) {
            $evt_category = new EventCategory();
            $evt_category->setLabel($this->evts[$i]);
                    
            $manager->persist($evt_category); // generate an object, keep it in memory in a generic array
        
            $this->addReference('evt_category-' . ($i+1), $evt_category);
        }
    }

/* EVENT */
    public function loadEvent($manager, $faker)
    {
       $evt_nb = 15;

        for($i=0; $i < $evt_nb; $i++) {
            $evt = new Event();
            $evt->setTitle( $faker->word( $nb = 3) )
                ->setDescription( $faker->text($maxNbChars = 60) ) 
                ->setEventDate( $faker->dateTimeBetween('now', '+2 years') )
                ->setImage( $faker->imageUrl($width = 640, $height = 480) ) 
                ->setCategoryId( $this->getReference(('evt_category-'. rand(1, count($this->evts)))) ); 

            $manager->persist($evt);
        }
    }

/* SUBSCRIBER ROLE */
    public function loadSubscriberRole($manager)
    {
        for($i=0; $i < count($this->role); $i++) {
            $subscriber_role = new SubscriberRole();
            $subscriber_role->setRole($this->role[$i]);
    
            $manager->persist($subscriber_role); 
        
            $this->addReference('subscriber_role-' . ($i+1), $subscriber_role);
        }
    }

/* SUBSCRIBER */
    public function loadSubscriber($manager, $faker)
    {
    /* Association */
        $atelier = new Subscriber();
        $atelier->setFirstName( "Atelier")
                    ->setLastName( "Vélo" ) 
                    ->setPhone( "(+33)0777365705" )
                    ->setAddress( "Rue du méridien, 66000 Perpignan" )  
                    ->setRole( $this->getReference(('subscriber_role-'. 1 ) ))   
                    ->setEmail( "atelierveloduvernet@protonmail.com" ); 

        $manager->persist($atelier);

        $this->addReference('association-' . 1, $atelier);

    /* Subscribers */
        for($i=1; $i < $this->subscribers_nb; $i++) {
            $subscriber = new Subscriber();
            $subscriber->setFirstName( $faker->firstName)
                        ->setLastName( $faker->lastName ) 
                        ->setPhone( $faker->phoneNumber )
                        ->setAddress( $faker->address )  
                        ->setRole( $this->getReference(('subscriber_role-'. 4 ) ))   
                        ->setEmail( $faker->email ); 

            $manager->persist($subscriber);
        }

    /* Employees / Volunteers */
        for($j=0; $j < $this->employee_nb; $j++) {
            $employee = new Subscriber();
            $employee->setFirstName( $faker->firstName)
                        ->setLastName( $faker->lastName ) 
                        ->setPhone( $faker->phoneNumber )
                        ->setAddress( $faker->address )  
                        ->setRole( $this->getReference(('subscriber_role-'. rand(2, 3) ) ))   
                        ->setEmail( $faker->email ); 

            $manager->persist($employee);

            $this->addReference('employee-' . ($j+1), $employee);
        }
    }

/* USER */
    public function loadUser($manager)
    {
    /* Association */
        $admin_user = new User();
        $admin_user->setUsername( "AtelierVelo")
                    ->setPassword( $this->pass_hasher->hashPassword($admin_user, 'velovelo' ))
                    ->setRoles( array("ROLE_ADMIN") )
                    ->setSubscriberRole( $this->getReference(('subscriber_role-'. 1 )) ) ;

        $manager->persist($admin_user);

    /* Volunteers */
        $user = new User();
        $user->setUsername( "Benevole" )
            ->setPassword( $this->pass_hasher->hashPassword($user, 'toto') )
            ->setRoles( array('ROLE_USER'))
            ->setSubscriberRole( $this->getReference(('subscriber_role-'. 2 )) ) ;

        $manager->persist($user);

        $user = new User();
        $user->setUsername( "Salarie" )
            ->setPassword( $this->pass_hasher->hashPassword($user, 'salarie') )
            ->setRoles( array('ROLE_USER'))
            ->setSubscriberRole( $this->getReference(('subscriber_role-'. 3 )) ) ;

        $manager->persist($user);
    }

    /* Services */
    public function loadServices($manager, $faker) {
        for ($i=0; $i < count( $this->services ); $i++) { 
            $service = new Service;
            $service->setLabel( $this->services[$i] )
                    ->setDescription( $faker->realText($maxNbChars = 200, $indexSize = 2)  );

        $manager->persist($service);

        }
    }
}
