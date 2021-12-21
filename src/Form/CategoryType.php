<?php

namespace App\Form;

use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('titre', TextType::class,['label' => 'Titre de l\'article :', 'required' => true, 'attr' => ['placeholder' => "Saisir le titre de l'article",], 'constraints' => [new Length(['min' => 5, 'max' => 50, 'minMessage' => "Titre trop court (min 5 caractères)", 'maxMessage' => "Titre trop long (max 50 caractères)"]), New NotBlank(['message' => "Merci de saisir un titre."])]])
        ->add('grdCat', ChoiceType::class, ['choices' => [ 'Cheveux' => 'Cheveux', 'Corps' => 'Corps', 'Kit' => 'Kit',], 'expanded' => false, 'multiple' => false, 'label' => "Définir la grande category ",])
        
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}
