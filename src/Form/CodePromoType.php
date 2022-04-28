<?php

namespace App\Form;

use App\Entity\CodePromo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class CodePromoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('code', TextType::class,[
                'label' => 'Titre du code (ex: BABY40)',
                'required' => true, 
                'attr' => [
                    'placeholder' => "Saisir le code",
                ], 
                'constraints' => [
                    new Length([
                        'min' => 5, 
                        'max' => 50, 
                        'minMessage' => "Titre trop court (min 5 caractères)", 
                        'maxMessage' => "Titre trop long (max 50 caractères)"
                    ]), 
                    New NotBlank([
                        'message' => "Merci de saisir un code."
                    ])
                ]
            ])
            
            ->add('promo', NumberType::class,[
                'label' => 'Montant de la promotion sur le panier (en %)', 
                'required' => true, 
                'attr' => [
                    'placeholder' => "Saisir la promo",
                ], 
                'constraints' =>[
                    New NotBlank([
                        'message' => "Merci de saisir une promotion."
                    ])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CodePromo::class,
        ]);
    }
}
