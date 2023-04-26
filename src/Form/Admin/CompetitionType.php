<?php

namespace App\Form\Admin;
use App\Entity\competition;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompetitionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('intitule')
             ->add('dateDebut')
             ->add('dateFin')
             ->add('typeMinimas')
        
            
            ->add('submit', SubmitType::class,
            [
                'label'=> 'Create',
                'attr' => ['class'=> 'btn indigo']

            ])
    ;
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
             'data_class' => competition::class,
        ]);
    }
}
