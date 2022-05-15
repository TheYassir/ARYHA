<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Service\MailerService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager, MailerService $mailer): Response
    {
        if($this->getUser())
        {
            return $this->redirectToRoute ('shop');
        }

        $user = new User();

        $form = $this->createForm(RegistrationFormType::class, $user, [
            'userRegistration' => true 
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $hash = $userPasswordHasher->hashPassword(
                $user,
                $form->get('password')->getData()
            );

            $user->setPassword($hash);
            $this->addFlash('success', "Félicitation ! Vous êtes maintenant inscrit sur le site !");
            $mailMessage = $user->getPrenom() . ' ' . $user->getNom() . ' vien de s\'inscrire sur ARHYA';
            
            $entityManager->persist($user);
            $mailer->sendEmail(content: $mailMessage, subject: 'Un nouveau inscris !');

            $entityManager->flush();

            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    #[Route('/profil', name: 'app_profil')]
    public function userProfil(Request $request, EntityManagerInterface $manager): Response
    {
        // cela permet de vérifier si l'utilisateur n'est pas connecté 
        if(!$this->getUser())
        {       
            // et si il ne l'est pas, on le redirige vers la page connexion
            return $this->redirectToRoute('app_login');
        }
        // Récupération des données de l'utilisateur
        $user = $this->getUser();

        // Si dans l'url, il existe la donnée 'op' 
        if( $request->query->get('op')) 
        {
            // Je crée le fomulaire de modification de l'utilisateur
            $formUpdate = $this->createForm(RegistrationFormType::class, $user, [
                'userUpdate' => true
            ]);

            // Vérifiacation de la reception de toutes les valeurs
            $formUpdate->handleRequest($request);
    
            // Si tout est bien rempli sans accro
            if($formUpdate->isSubmitted() && $formUpdate->isValid())
            {
                // On charge la valeur $user dans le $manager
                $manager->persist($user);
                // Et on l'envoi en bdd
                $manager->flush();
    
                $this->addFlash('success', 'Vous avez modifié vos informations. Merci de vous authentifié de nouveau');
    
                return $this->redirectToRoute('app_profil');
            }
        }
        

        return $this->render('registration/profil.html.twig', [
            'user' => $user,
            'formUpdate' => (isset($formUpdate)) ? $formUpdate->createView() : ''
        ]);

    }
}
