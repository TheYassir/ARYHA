<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Taille;
use App\Repository\CategoryRepository;
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
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class,[
                'label' => 'Titre de l\'article :',
                'required' => true, 
                'attr' => [
                ], 
                'constraints' => [
                    new Length([
                        'min' => 5, 
                        'max' => 50, 
                        'minMessage' => "Titre trop court (min 5 caractères)", 
                        'maxMessage' => "Titre trop long (max 50 caractères)"
                    ]), 
                    New NotBlank([
                        'message' => "Merci de saisir un titre."
                    ])
                ]
            ])

            ->add('description', TextareaType::class,[
                'label' => 'Description de l\'article :', 
                'required' => false, 
                'attr' => [
                    'placeholder' =>"Saisir la description de l'article", 
                    'rows' => 5
                ],
                'constraints' =>[
                    New NotBlank([
                        'message' => "Merci de saisir une description d'article"
                    ])
                ]
            ])

            ->add('photo', FileType::class,[
                'label' => 'Uploader une première photo :', 
                "mapped" => false,
                'required' => false,
                "data_class" => null,
                'constraints' => [
                    new File([
                        'maxSize' => '5M', 
                        'mimeTypes' => [
                            'image/jpeg', 
                            'image/png', 
                            'image/jpg'
                        ],
                    "mimeTypesMessage" => 'Format autorisés : jpg/png/jpeg.'
                    ])
                ]
            ])
            ->add('photo2', FileType::class,[
                'label' => 'Uploader une seconde photo :', 
                "mapped" => false,
                'required' => false,
                "data_class" => null,
                'constraints' => [
                    new File([
                        'maxSize' => '5M', 
                        'mimeTypes' => [
                            'image/jpeg', 
                            'image/png', 
                            'image/jpg'
                        ],
                    "mimeTypesMessage" => 'Format autorisés : jpg/png/jpeg.'
                    ])
                ]
            ])
            ->add('photo3', FileType::class,[
                'label' => 'Uploader une troisième photo :', 
                "mapped" => false,
                'required' => false,
                "data_class" => null,
                'constraints' => [
                    new File([
                        'maxSize' => '5M', 
                        'mimeTypes' => [
                            'image/jpeg', 
                            'image/png', 
                            'image/jpg'
                        ],
                    "mimeTypesMessage" => 'Format autorisés : jpg/png/jpeg.'
                    ])
                ]
            ])
            ->add('photo4', FileType::class,[
                'label' => 'Uploader une quatrième photo :', 
                "mapped" => false,
                'required' => false,
                "data_class" => null,
                'constraints' => [
                    new File([
                        'maxSize' => '5M', 
                        'mimeTypes' => [
                            'image/jpeg', 
                            'image/png', 
                            'image/jpg'
                        ],
                    "mimeTypesMessage" => 'Format autorisés : jpg/png/jpeg.'
                    ])
                ]
            ])
            ->add('photo5', FileType::class,[
                'label' => 'Uploader une cinquième photo :', 
                "mapped" => false,
                'required' => false,
                "data_class" => null,
                'constraints' => [
                    new File([
                        'maxSize' => '5M', 
                        'mimeTypes' => [
                            'image/jpeg', 
                            'image/png', 
                            'image/jpg'
                        ],
                    "mimeTypesMessage" => 'Format autorisés : jpg/png/jpeg.'
                    ])
                ]
            ])
            ->add('photo6', FileType::class,[
                'label' => 'Uploader une sixième photo :', 
                "mapped" => false,
                'required' => false,
                "data_class" => null,
                'constraints' => [
                    new File([
                        'maxSize' => '5M', 
                        'mimeTypes' => [
                            'image/jpeg', 
                            'image/png', 
                            'image/jpg'
                        ],
                    "mimeTypesMessage" => 'Format autorisés : jpg/png/jpeg.'
                    ])
                ]
            ])

            ->add('prix', NumberType::class,[
                'label' => 'Prix de l\'article :', 
                'required' => true, 
                'attr' => [
                    'placeholder' => "Saisir le prix de l'article",
                ], 
                'constraints' =>[
                    New NotBlank([
                        'message' => "Merci de saisir un prix."
                    ])
                ]
            ])

            ->add('couleur', ChoiceType::class,[
                'choices' => [
                    'Noir' => 'Noir',
                    'Blanc' => 'blanc', 
                    'Rouge' => 'rouge', 
                    'Vert' => 'vert', 
                    'Bleu' => 'bleu', 
                    'Jaune' => 'jaune', 
                    'Violet' => 'Violet', 
                    'Rose' => 'Rose', 
                    'Bordeaux' => 'Bordeaux',
                    'Gris' => 'Gris',
                    'Marron' => 'Marron',
                    'Beige' => 'Beige',

                ], 
                'expanded' => false, 
                'multiple' => false, 
                'label' => "Définir la couleur de l'article",
            ])

            ->add('category', EntityType::class,[
                'label' => "Choisir une catégorie", 
                'class' => Category::class, 
                'choice_label' => 'titre'
            ])
        ;
            // $builder->get('taille')->addEventListener(
            //     FormEvents::POST_SUBMIT,
            //     function(FormEvent $event){
            //         $form = $event->getForm();
            //         $form->getParent()->add('stock', NumberType::class,['label' => 'Stock de l\'article :', 'required' => true, 'attr' => ['placeholder' => "Saisir le stock de l'article",], 'constraints' =>[New NotBlank(['message' => "Merci de saisir un stock."])]]);
            //     }
            // );
            // $builder->get('taille')->addEventListener(
            //     FormEvents::POST_SUBMIT,
            //     function(FormEvent $event){
            //         $form = $event->getForm();
            //         $form->getParent()->add('grandeCategory', NumberType::class,['label' => 'Stock de l\'article :', 'required' => true, 'attr' => ['placeholder' => "Saisir le stock de l'article",], 'constraints' =>[New NotBlank(['message' => "Merci de saisir un stock."])]]);
            //     }
            // );

    }
    
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
