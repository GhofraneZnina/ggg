<?php

namespace App\Form\Admin;

use App\Entity\Planning;
use App\Entity\Saison;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Validator\Constraints\NotBlank;
class PlanningType extends AbstractType
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
     ->add('dateFin', TextType::class,
     [
        'invalid_message'=> 'please check your information',
         'label'=>false,
        'required'=> false,'mapped'=>false,

     ])
    // ->add('date', TextType::class, [
    //      'invalid_message' => 'Please check your information',
    //      'label' => false,
    //      'required' => false,
    //      'mapped' => false,
    //      'constraints' => [
    //          new NotBlank(['message' => 'This field cannot be empty.']),
    //          new Callback(function ($date, ExecutionContextInterface $context) use ($builder) {
    //              $data = $builder->getData();
    //              $saison = $data->getSaison();
    //              $dateFin = $data->getDateFin();
                    
    //          if ($date > $dateFin) {
    //                  $context->buildViolation('The dateDebut must be before the dateFin')
    //                      ->atPath('date')
    //                      ->addViolation();
    //              }
    //          })
    //    ]
    //  ])
    //  ->add('dateFin', TextType::class, [
    //      'invalid_message' => 'Please check your information',
    //      'label' => false,
    //      'required' => false,
    //      'mapped' => false,
    //      'constraints' => [
    //          new NotBlank(['message' => 'This field cannot be empty.']),
    //          new Callback(function ($dateFin, ExecutionContextInterface $context) use ($builder) {
    //              $data = $builder->getData();
    //            $saison = $data->getSaison();
    //             $date = $data->getDate();
                    
    //              if ($dateFin < $date) {
    //                  $context->buildViolation('The dateFin must be after the dateDebut')
    //                      ->atPath('dateFin')
    //                      ->addViolation();
    //             }
    //          })
    //      ]
    // ])
       
       
        ->add('label')
        ->add('LieuEntrainement')

        
       
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
            'data_class' => Planning::class,
        ]);
    }
}
