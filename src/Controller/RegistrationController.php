<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
         // Si getUser() renvoi des données, cela veut dire que l'internaute est authentifié, il n'a rien à faire sur la route '/register', on le redirige vers la route de connexion '/blog'
        if($this->getUser())
        {
            return $this->redirectToRoute ('shop');
        }

        $user = new User();

        $form = $this->createForm(RegistrationFormType::class, $user, [
            'userRegistration' => true // on precise dans quelle condition on entre, dans la classe registrationFormType pour afficher un formulaire en particulier, la classe contient plusieur formulaire
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            // fait appel a l'objet $userPasswordHasher de la classe UserPasswordHasherInterface afin d'encoder le mot de passe en BDD
            // En argument on lui fournit l'objet entité dans lequel nous allons encoder un élément ($user) et on lui fournit le mot de passe saisi dans le formulaire a encoder
            $hash = $userPasswordHasher->hashPassword(
                $user,
                $form->get('password')->getData()
            );

            //dd($hash);

            // on transmet au setter du password la clé de hachage à enregistrer en bdd
            $user->setPassword($hash);

            $this->addFlash('success', "Félicitation ! Vous êtes maintenant inscrit sur le site !");

            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    #[Route('/profil', name: 'app_profil')]
    public function userProfil(): Response
    {
        if(!$this->getUser())
        {
            return $this->redirectToRoute('app_login');
        }
        $user= $this->getUser();

        return $this->render('registration/profil.html.twig', [
            'user' => $user
        ]);

    }

    #[Route('/profil/{id}/edit', name: 'app_profil_edit')]
    public function userProfilEdit(User $user, Request $request, EntityManagerInterface $manager): Response
    {
        $formUpdate = $this->createForm(RegistrationFormType::class, $user, [
            'userUpdate' => true
        ]);

        $formUpdate->handleRequest($request);
        
        if($formUpdate->isSubmitted() && $formUpdate->isValid())
        {
            $manager->persist($user);
            $manager->flush();

            $this->addFlash('success', 'Vous avez modifié vos informations, merci de vous authentifié de nouveau');

            return $this->redirectToRoute('app_logout');
        }

        return $this->render('registration/profil_edit.html.twig', [
            'formUpdate' => $formUpdate->createView()
        ]);
    }
}
