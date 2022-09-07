<?php

namespace App\Form;

use App\Entity\Subscriber;
use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Repository\SubscriberRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username')
            ->add('password', PasswordType::class)
            ->add('role')
            ->add('subscriber', EntityType::class, [
                'label' => 'Nom du bénévole',
                'query_builder' => function(SubscriberRepository $subscriberRepo) { 
                    return $subscriberRepo->orderName();
                },
                'class' => Subscriber::class,
                'choice_label' => function(Subscriber $subscriberRepo) { 
                    return $subscriberRepo->getFullName();
                },

                'expanded' => false,
                'multiple' => false,
                'required' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
