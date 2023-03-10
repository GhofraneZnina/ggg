<?php
namespace App\Form\Admin;

use App\Entity\Nageur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class NageurType extends AbstractType
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
                    'mapped'=>true,
                    'first_options'=>  ['label'=> false],
                    'second_options'=>  ['label'=> false]

                ])
            ->add('email')
            ->add('nom')
            ->add('prenom')
            ->add('telephone')
            ->add('profileFacebook')
            ->add('numLicence')
            ->add('dateLicence', TextType::class,
            [
                'invalid_message'=> 'please check your information',
                'label'=>false,
                'required'=> false,'mapped'=>false,

            ])
            ->add('dateLicence')
            ->add('photo')
            ->add('typeEtablissement', ChoiceType::class, [
                'choices'  => ['SYSTEME_TN' => 'systeme tunisien' ,
                    'SYSTEME_CN' => 'systeme canadien' ,
                    'SYSTEME_FR' => 'systeme francais' ,
                'SYSTEME_AUTRE'=>'autre systeme']
                
            ])
            
            ->add('dateDebutActiviteSportive', TextType::class,
            [
                'invalid_message'=> 'please check your information',
                'label'=>false,
                'required'=> false,'mapped'=>false,

            ])
            ->add('remarque')
            ->add('dateNaissance', TextType::class,
            [
                'invalid_message'=> 'please check your information',
                'label'=>false,
                'required'=> false,'mapped'=>false,

            ])
            ->add('genre', ChoiceType::class, [
                'choices'  => ['FEMME' => 'femme' ,
                    'HOMME' => 'homme' 
                   
               ]
                
            ])
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
            'data_class' => Nageur::class,
        ]);
    }
} 

?>