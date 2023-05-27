<?php

namespace App\Form\Admin;

use App\Entity\Seance;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class SeanceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('horaireDebut')
            ->add('horaireFin')
            
            
            ->add('groupe')
            ->add('jour', ChoiceType::class, [
                'choices'  => [
                    Seance::LUNDI => Seance::LUNDI ,
                Seance::MARDI => Seance::MARDI, Seance::MERCREDI => Seance::MERCREDI, Seance::JEUDI => Seance::JEUDI,
                Seance::SAMEDI => Seance::SAMEDI, Seance::DIMANCHE => Seance::DIMANCHE,
                
            ]])
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
            'data_class' => Seance::class,
        ]);
    }
}
