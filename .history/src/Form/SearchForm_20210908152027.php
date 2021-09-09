<?php

namespace App\Form;

use App\Data\SearchData;
use App\Entity\Movies;
use App\Entity\Nationalities;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class SearchForm extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('search', TextType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Rechercher par réalisateur ou film'
                ]
            ])
            ->add('year', ChoiceType::class, [
                'label' => false,
                'required' => false,
                'expanded' => false,
                'multiple' => false
            ])

            ->add('nationalite', ChoiceType::class, [
                'label' => false,
                'choices' => ['name'],
                'required' => false,
                'expanded' => false,
                'multiple' => false
            ])
            ->add('last', ChoiceType::class, [
                'label' => false,
                'required' => false,
                'expanded' => false,
                'multiple' => false
            ])
        


        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SearchData::class,
            'method' => 'GET',
            'csrf_protection' => false
        ]);
    }


}
