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


class NageurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('login')
            ->add('password')
            ->add('email')
            ->add('nom')
            ->add('prenom')
            ->add('telephone')
            ->add('profileFacebook')
            ->add('num_licence')
            ->add('date_licence')
            ->add('photo')
            ->add('typeEtablissement', ChoiceType::class, [
                'choices'  => ['SYSTEME_TN' => 'systeme tunisien' ,
                    'SYSTEME_CN' => 'systeme canadien' ,
                    'SYSTEME_FR' => 'systeme francais' ,
                'SYSTEME_AUTRE'=>'autre systeme']
                
            ])
            
            ->add('dateDebutActiviteSportive', DateTimeType::class)
            ->add('remarque')
            ->add('date_naissance')
            ->add('genre')
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