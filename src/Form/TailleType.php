<?php

namespace App\Form;

use App\Entity\Taille;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class TailleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        if($options['tailleBack'] == true)
        {
            $builder
            ->add('stock', NumberType::class,[
                    'label' => 'Stock de l\'article :', 
                    'required' => true, 
                    'attr' => [
                        'placeholder' => "Saisir le stock de l'article",
                    ], 
                    'constraints' =>[
                        New NotBlank([
                            'message' => "Merci de saisir un stock."
                        ])
                    ]
                ])
            ;
        }
        elseif($options['tailleFront'] == true)
        {
            $builder
            ->add('titre', ChoiceType::class,[
                    'expanded' => false, 
                    'multiple' => false,
                    'label' => "Définir la taille de votre article",
                ])
            ;
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Taille::class,
            'tailleFront' => false,
            'tailleBack' => false,
        ]);
    }
}
