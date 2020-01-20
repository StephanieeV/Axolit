<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\TelType;

class InformationsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class)
            ->add('pseudo', TextType::class,['required'=>false])
            ->add('nom', TextType::class)
            ->add('prenom', TextType::class)
            // ->add('civilite', RadioType::class)
            ->add('codepostal', IntegerType::class, ['required'=>false])
            ->add('adresse', TextType::class,['required'=>false])
            ->add('ville', TextType::class,['required'=>false])
            ->add('telephone', TelType::class,['required'=>false])
            ->add('ddn', BirthdayType::class,['required'=>false])
            // ->add('badges', CheckboxType::class)
            // ->add('badges')
            ->add('password', PasswordType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
