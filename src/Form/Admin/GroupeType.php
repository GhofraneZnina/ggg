<?php

namespace App\Form\Admin;
use App\Entity\groupe;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GroupeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('intitule')
            ->add('entraineur')
        
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
            'data_class' => groupe::class,
        ]);
    
    }
}
