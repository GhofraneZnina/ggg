<?php

namespace App\Form\Admin;
use App\Entity\Performance;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PerformanceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('chrono')
            
            ->add('date', TextType::class,
            [
                'invalid_message'=> 'please check your information',
                'label'=>false,
                'required'=> false,'mapped'=>false,

            ])
           
             ->add('type')
             ->add('nageur')
             ->add('programmeCompetition')
            
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
             'data_class' => Performance::class,
        ]);
    }
}
