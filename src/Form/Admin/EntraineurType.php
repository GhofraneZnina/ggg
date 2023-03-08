<?php
namespace App\Form\Admin;

use App\Entity\Entraineur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;


class EntraineurType extends AbstractType
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
            //->add('dateNaissance', DateTimeType::class)
            ->add('dateNaissance',DateType::class)
            ->add('description')
            ->add('photo')
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
            'data_class' => Entraineur::class,
        ]);
    }
} 

?>