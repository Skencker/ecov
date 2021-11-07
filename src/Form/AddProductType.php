<?php

namespace App\Form;

use App\Entity\Categories;
use App\Entity\Deal;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Products;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class AddProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        
        $builder
            ->add('name', TextType::class, [
                'label' => ' Nom',
                'attr' => [
                    'placeholder' => 'Entrer le nom du produit'
                ]
            ])
            ->add('image', TextType::class, [
                'label' => ' Image',
                'attr' => [
                    'placeholder' => 'Entrer le nom du produit'
                ]
            ])
            ->add('slug', TextType::class, [
                'label' => ' slug',
                'attr' => [
                    'placeholder' => 'Entrer le nom du produit'
                ]
            ])
            ->add('price', MoneyType::class, [
                'label' => ' Prix',
                'attr' => [
                    'placeholder' => 'Entrer le prix du produit'
                ]
            ])
            ->add('description', TextareaType::class, [
                'label' => ' Description',
                'attr' => [
                    'placeholder' => 'Entrer la description du produit'
                ]
            ])
         
            ->add('category', EntityType::class, [
                'class' => Categories::class
                
            ])
            ->add('deal', EntityType::class, [
                'class' => Deal::class
             
            ])
            ->add('user', HiddenType::class, [
                // 'data' => 
                ])

                    
            ->add('submit', SubmitType::class, [
                'label' => 'Envoyer', 
                'attr' => [
                    'class' => 'btn btn-success'
                ]
            ]) 
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
