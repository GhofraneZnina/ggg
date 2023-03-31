<?php

namespace App\Form\Admin;

use App\Entity\LieuEntrainement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class LieuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        
     
        ->add('intitule')
        ->add('description')

        ->add('typepicine', ChoiceType::class, [
            'choices'  => [ 'PICINE_1'=>'P50',
            'P50' => 'PICINE_1'  ,
            'P25M' => 'PICINE_2' ,
            'AUTRE'=>'autre']
            
        ])
       



        // ->add('TypePicine', ChoiceType::class, [
        //     'choices'  => [
        //         LieuEntrainement::'p50' =>LieuEntrainement::'p25m' ,
        //         LieuEntrainement::'autre',           
        // ]])
       
            
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
            'data_class' => LieuEntrainement::class,
        ]);
    }
}
