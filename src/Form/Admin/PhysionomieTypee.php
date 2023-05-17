<?php

namespace App\Form\Admin;

use App\Entity\Physionomie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class PhysionomieTypee extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('date', TextType::class,
        [
            'invalid_message'=> 'please check your information',
            'label'=>false,
            'required'=> false,'mapped'=>false,

        ])
     
        ->add('taille')
        ->add('poids')
        ->add('nageur')
            
        ->add('submit', SubmitType::class,
            [
                'label'=> 'Créer',
                'attr' => ['class'=> 'btn indigo']

            ])
    ;
}

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Physionomie::class,
        ]);
    }
}
