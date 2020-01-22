<?php

namespace App\Form;

use App\Entity\TypeAnnonce;
use App\Entity\TypeAppareil;
use App\Entity\Annonce;
//pour construire une query et afficher dans le form les entités séléctionnée
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use App\Form\DataTransformer\ModeleToLibelleTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class AnnonceType extends AbstractType
{


    public function __construct(ModeleToLibelleTransformer $transformer)
    {
        $this->transformer = $transformer;
    }


    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('titre', TextType::class)
            ->add('prix', IntegerType::class)
            /* ->add('localisation', TextType::class) */
            ->add('texte_annonce', TextareaType::class)
            ->add('modele', TextType::class)

            ->add(
                'typeannonce',
                EntityType::class,
                [
                    'class' => TypeAnnonce::class,
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('at')
                            ->orderBy('at.libelle', 'ASC');
                    },
                    'choice_label' => 'libelle',
                    'multiple' => false,
                    'expanded' => true,
                ]
            )

            ->add(
                'typeappareil',
                EntityType::class,
                [
                    'class' => TypeAppareil::class,
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('at')
                            ->orderBy('at.libelle', 'ASC');
                    },
                    'choice_label' => 'libelle',
                    'multiple' => false,
                    'placeholder' => 'Choisissez le type d\'appareil',
                ]
            )


            //On récupère  une simple chaine de caractère qui sera converti en entité avec ce transformer 
            ->get('modele')
            ->addModelTransformer($this->transformer);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Annonce::class,
            'csrf_protection' => false
        ]);
    }
}
