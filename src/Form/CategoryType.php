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
        ->add('sexe', ChoiceType::class, [
            'choices' => [ 'Homme' => 'Homme', 'Femme' => 'Femme'], 
            'expanded' => false, 
            'multiple' => false,
            'label' => "Genre"])
        ->add('titre', TextType::class,['label' => 'Titre de la catégorie :', 'required' => true, 'attr' => ['placeholder' => "Saisir le titre de l'article",], 'constraints' => [new Length(['min' => 3, 'max' => 50, 'minMessage' => "Titre trop court (min 3 caractères)", 'maxMessage' => "Titre trop long (max 50 caractères)"]), New NotBlank(['message' => "Merci de saisir un titre."])]])
        ->add('grdCat', ChoiceType::class, ['choices' => [ 'Sacs' => 'Sacs', 'Prêt-à-porter' => 'Prêt-à-porter', 'Souliers' => 'Souliers', 'Parfums' => 'Parfums', 'Accessoires' => 'Accessoires', 'Portefeuilles' => 'Portefeuilles', 'Horlogerie et joaillerie' => 'Horlogerie et joaillerie',], 'expanded' => false, 'multiple' => false, 'label' => "Définir la grande category ",])
        
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}
