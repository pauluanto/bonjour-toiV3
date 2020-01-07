<?php

namespace App\Form;

use App\Entity\Modele;
use App\Entity\Voiture;
use phpDocumentor\Reflection\Types\Null_;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotNull;

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
