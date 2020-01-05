<?php

namespace App\Form;

use App\Entity\Modele;
use App\Entity\Voiture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VoitureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pseudo')
            ->add('ville')
            ->add('taille')
            ->add('jerecherche')
            ->add('annedenaissance')
            ->add('description')
            ->add('couleurYeux')
            ->add('couleurCheveux')
            ->add('citation')
            ->add('livres')
            ->add('films')
            ->add('loisirs')
            ->add('langueParle')

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Voiture::class,
        ]);
    }
}
