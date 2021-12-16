<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class,['label' => 'Titre de l\'article :', 'required' => true, 'attr' => ['placeholder' => "Saisir le titre de l'article",], 'constraints' => [new Length(['min' => 10, 'max' => 50, 'minMessage' => "Titre trop court (min 10 caractères)", 'maxMessage' => "Titre trop long (max 50 caractères)"]), New NotBlank(['message' => "Merci de saisir un titre."])]])
            ->add('description', TextareaType::class, ['label' => 'Description de l\'article :', 'required' => false, 'attr' => ['placeholder' =>"Saisir la description de l'article", 'rows' => 5],'constraints' =>[New NotBlank(['message' => "Merci de saisir unz description d'article"])]])
            ->add('photo', FileType::class, ['label' => 'Uploader une photo :', "mapped" => true,'required' => false,"data_class" => null,'constraints' => [new File(['maxSize' => '5M', 'mimeTypes' => ['image/jpeg', 'image/png', 'image/jpg'],"mimeTypesMessage" => 'Format autorisés : jpg/png/jpeg.'])]])
            ->add('prix', NumberType::class,['label' => 'Prix de l\'article :', 'required' => true, 'attr' => ['placeholder' => "Saisir le prix de l'article",], 'constraints' =>[New NotBlank(['message' => "Merci de saisir un prix."])]])
            ->add('stock', NumberType::class,['label' => 'Stock de l\'article :', 'required' => true, 'attr' => ['placeholder' => "Saisir la quantité stock de l'article",], 'constraints' =>[New NotBlank(['message' => "Merci de saisir la quantité du stock."])]])
            ->add('couleur', ChoiceType::class, ['choices' => [ 'Noir' => 'Noir', 'Rouge' => 'rouge', 'Vert' => 'vert', 'Bleu' => 'bleu', 'Jaune' => 'jaune', 'Violet' => 'Violet', 'Rose' => 'Rose', 'Bordeaux' => 'Bordeaux', ], 'expanded' => false, 'multiple' => false, 'label' => "Définir la couleur de l'article",])
            ->add('category', EntityType::class, ['label' => "Choisir une catégorie", 'class' => Category::class, 'choice_label' => 'titre'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
