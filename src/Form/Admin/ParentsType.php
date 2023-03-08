<?php

namespace App\Form\Admin;

use App\Entity\Parents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;


class ParentsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('login')
            ->add('password', RepeatedType::class,
                [
                    'type' => PasswordType::class,
                    'invalid_message'=> 'please check password',
                    'label'=> 'Password',
                    'required'=> false,
                    'mapped'=> false,
                    'first_options'=>  ['label'=> false],
                    'second_options'=>  ['label'=> false]

                ])
            ->add('email')
            ->add('nom')
            ->add('prenom')
            ->add('telephone')
            ->add('profileFacebook')
            ->add('remarque')
            ->add('ville')
            ->add('adresse')
            ->add('type')





            ->add('submit', SubmitType::class,
                [
                    'label'=> 'Create',
                    'attr' => ['class'=> 'btn indigo']

                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Parents::class,
        ]);
    }
}
