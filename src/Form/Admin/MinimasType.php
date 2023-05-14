<?php

namespace App\Form\Admin;

use App\Entity\Minimas;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class MinimasType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        
     
        ->add('genre', ChoiceType::class, [
            'choices'  => [
                Minimas::FILLE => Minimas::FILLE ,
            Minimas::GARCON => Minimas::GARCON
            
        ]])
        ->add('chrono')

        ->add('typeMinimas')
        ->add('categorie')
        ->add('nage')

        
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
            'data_class' =>Minimas::class,
        ]);
    }
}
