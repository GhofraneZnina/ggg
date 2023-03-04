<?php

namespace App\Form;

use App\Entity\Nageur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NageurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numLicence')
            ->add('dateLicence')
            ->add('photo')
            ->add('typeEtablissement')
            ->add('dateDebutActiviteSprtive')
            ->add('remarque')
            ->add('dateNaissance')
            ->add('genre')
            ->add('user')
            ->add('parents')
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