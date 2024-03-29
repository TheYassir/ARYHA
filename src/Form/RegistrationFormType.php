<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        if($options['userRegistration'] == true)
        {
            $builder
                ->add('email', TextType::class, [
                    'required' => true,
                    'constraints' => [
                        new NotBlank([
                            'message' => "Veuillez renseigner votre email"
                        ])
                    ]
                ])
                ->add('pseudo', TextType::class, [
                    'required' => true,
                    'constraints' => [
                        new NotBlank([
                            'message' => "Veuillez renseigner votre pseudo"
                        ])
                    ]
                ])
                
                ->add('nom', TextType::class, [
                    'required' => true,
                    'constraints' => [
                        new NotBlank([
                            'message' => "Veuillez renseigner votre nom"
                        ])
                    ]
                ])

                ->add('prenom', TextType::class, [
                    'required' => true,
                    'constraints' => [
                        new NotBlank([
                            'message' => "Veuillez renseigner votre prenom"
                        ])
                    ]
                ])
                ->add('sexe', ChoiceType::class, [
                    'choices' => [ 'Homme' => 'Homme', 'Femme' => 'Femme'], 
                    'expanded' => false, 
                    'multiple' => false, 
                    'label' => "Civilité"])

                ->add('telephone', TextType::class, [
                    'required' => true,
                    'constraints' => [
                        new NotBlank([
                            'message' => "Veuillez renseigner votre numéro de téléphone"
                        ])
                    ]
                ])                    

                ->add('adresse', TextType::class, [
                    'required' => true,
                    'constraints' => [
                        new NotBlank([
                            'message' => "Veuillez renseigner votre adresse"
                        ])
                    ]
                ])
                ->add('ville', TextType::class, [
                    'required' => true,
                    'constraints' => [
                        new NotBlank([
                            'message' => "Veuillez renseigner votre ville"
                        ])
                    ]
                ])
                ->add('codePostal', NumberType::class, [
                    'required' => true,
                    'constraints' => [
                        new NotBlank([
                            'message' => "Veuillez renseigner votre code postale"
                        ])
                    ]
                ])
                
                ->add('password', RepeatedType::class, [
                    'type' => PasswordType::class,
                    'required' => true,
                    'invalid_message' => "les mots de passe ne correspondent pas",
                    'options' => [
                        'attr' => [
                            'class' => 'password-field'
                        ]
                    ],
                    'first_options' => [
                        'label' => 'Mot de passe'
                    ],
                    'second_options' => [
                        'label' => "Confirmer votre mot de passe"
                    ],
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Veuillez renseigner votre mot de passe'
                        ]),
                        new Length([
                            'min' => 8,
                            'minMessage' => "Votre mot de passe est trop court"
                        ])
                    ]
                ])
            ;
        }
        elseif($options['userUpdate'] == true)
        {
            $builder
                ->add('email', TextType::class, [
                    'required' => true,
                    'constraints' => [
                        new NotBlank([
                            'message' => "Veuillez renseigner votre email"
                        ])
                    ]
                ])
                ->add('pseudo', TextType::class, [
                    'required' => true,
                    'constraints' => [
                        new NotBlank([
                            'message' => "Veuillez renseigner votre pseudo"
                        ])
                    ]
                ])
                
                ->add('nom', TextType::class, [
                    'required' => true,
                    'constraints' => [
                        new NotBlank([
                            'message' => "Veuillez renseigner votre nom"
                        ])
                    ]
                ])

                ->add('prenom', TextType::class, [
                    'required' => true,
                    'constraints' => [
                        new NotBlank([
                            'message' => "Veuillez renseigner votre prenom"
                        ])
                    ]
                ])
                ->add('sexe', ChoiceType::class, [
                    'choices' => [ 'Homme' => 'Homme', 'Femme' => 'Femme'], 
                    'expanded' => false, 
                    'multiple' => false, 
                    'label' => "Civilité"])

                ->add('telephone', TextType::class, [
                    'required' => true,
                    'constraints' => [
                        new NotBlank([
                            'message' => "Veuillez renseigner votre numéro de téléphone"
                        ])
                    ]
                ])                    

                ->add('adresse', TextType::class, [
                    'required' => true,
                    'constraints' => [
                        new NotBlank([
                            'message' => "Veuillez renseigner votre adresse"
                        ])
                    ]
                ])
                ->add('ville', TextType::class, [
                    'required' => true,
                    'constraints' => [
                        new NotBlank([
                            'message' => "Veuillez renseigner votre ville"
                        ])
                    ]
                ])
                ->add('codePostal', NumberType::class, [
                    'required' => true,
                    'constraints' => [
                        new NotBlank([
                            'message' => "Veuillez renseigner votre code postale"
                        ])
                    ]
                ])
            ;
        }
        elseif($options['userUpdateBack'] == true)
        {
            $builder
            ->add('roles', ChoiceType::class, [
                'required' => false,
                'multiple' => false,
                'expanded' => false,
                'choices'  => [
                  'User' => '',
                  'Admin' => 'ROLE_ADMIN',
                ],
            ]);

                     // Data transformer
            $builder->get('roles')
            ->addModelTransformer(new CallbackTransformer(
                function ($rolesArray) {
                    // transform the array to a string
                    return count($rolesArray)? $rolesArray[0]: null;
                },
                function ($rolesString) {
                    // transform the string back to an array
                    return [$rolesString];
                }
            ));
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'userRegistration' => false,
            'userUpdateBack' => false,
            'userUpdate' => false
        ]);
    }
}
