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
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;



class EntraineurType extends AbstractType
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
                'mapped'=> false,
                'first_options'=>  ['label'=> false],
                'second_options'=>  ['label'=> false]

            ])
            ->add('email')
            ->add('nom')
            ->add('prenom')
            ->add('telephone')
            ->add('profileFacebook')
            //->add('dateNaissance', DateTimeType::class)
            ->add('dateNaissance', TextType::class,
            [
                'invalid_message'=> 'please check your information',
                'label'=>false,
                'required'=> false,'mapped'=>false,

            ])
            
            ->add('description')
            ->add('photo' , FileType::class, [
                'label' => 'photo',

                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
               
                        
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
            'data_class' => Entraineur::class,
        ]);
    }
} 

?>