<?php

namespace App\Form;

use App\Entity\RealEstateAd;
use App\Entity\Tag;
use Faker\Provider\Text;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RealEstateAdType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre'
            ])

            ->add('password', RepeatedType::class, [
                'label' => 'PWD',
                'mapped' => false,
                'type' => PasswordType::class,
                'first_options' => [
                    'label' => 'Votre pass'
                ],
                'second_options' => [
                    'label' => 'Répéter votre pass'
                ]
            ])

            ->add('description', TextareaType::class, [
                'label' => 'Description'
            ])
            ->add('price', NumberType::class, [
                'label' => 'Prix de votre bien'
            ])
            ->add('gender', ChoiceType::class, [
                'mapped' => false,
                'choices' => [
                    'Mec' => 'm',
                    'Dame' => 'f'
                ],
            ])
            ->add('tags', EntityType::class, [
                'class' => Tag::class,
                'multiple' => true,
                'choice_label' => 'name'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RealEstateAd::class,
        ]);
    }
}
