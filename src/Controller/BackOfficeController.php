<?php

namespace App\Controller;

use App\Entity\Article;
use App\Controller\ShopController;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class BackOfficeController extends AbstractController
{

    #[Route('/admin', name: 'app_admin')]
    public function index(): Response
    {
        return $this->render('back_office/index.html.twig', [
            'title' => 'Admin | Home',
        ]);
    }

    #[Route('/admin/articles', name: 'app_admin_articles')]
    #[Route('/admin/articles/{id}/remove', name: 'app_admin_articles_remove')]
    public function adminArticles(EntityManagerInterface $manager, ArticleRepository $repoArticle, Article $artRemove = null, ShopController $artUpdate): Response
    {
        $colonnes = $manager->getclassMetadata(Article::class)->getFieldNames();
        $cellules = $repoArticle->findAll();

        if($artRemove)
        {
            $id = $artRemove->getId();
            $manager->remove($artRemove);
            $manager->flush();
            $this->addFlash('success', "L'article n°$id a bien été supprimer avec succès");
            return $this->redirectToRoute('app_admin_articles');
        }
        return $this->render('back_office/admin_articles.html.twig', [
            'colonnes' => $colonnes, // 
            'cellules' => $cellules
        ]);
    }





    // Affichage et suppression des Users

// USERS

    #[Route('/admin/utilisateurs', name: 'app_admin_utilisateurs')] // Affichage des users
    #[Route('/admin/utilisateurs/{id}/update', name: 'app_admin_utilisateurs_update')] // modification
    #[Route('/admin/utilisateurs/{id}/remove', name: 'app_admin_utilisateurs_remove')] // suppression
    public function adminUsers(EntityManagerInterface $manager, UtilisateurRepository $repoUtilisateur, Utilisateur $utilisateur = null, Request $request): Response
    {
        //dd($user);
        //dd($request->query);

        $colonnes = $manager->getClassMetadata(Utilisateur::class)->getFieldNames();
        // dd($colonnes);

        $utilisateurs = $repoUtilisateur->findAll();
        //dd($user);

        // Si $user retourne true, cela veut que $user les informations d'1 user stocké en BDD
        if($utilisateur)
        {
            // Si l'indice 'op' est définit dans l'URL et qu'il a pour valeur 'update', alors on entre dans la condition et on execute une requete 'update'.
            if($request->query->get('op') == 'update')
            {
                // dd('update');
                $formUtilisateurUpdate = $this->createForm(RegistrationFormType::class, $utilisateur, [
                    'utilisateurUpdateBack' => true
                ]);

                $formUtilisateurUpdate->handleRequest($request);

                if($formUtilisateurUpdate->isSubmitted() && $formUtilisateurUpdate->isValid())
                {
                    $infos = $utilisateur->getPrenom() . " " . $utilisateur->getNom();

                    $manager->persist($utilisateur);
                    $manager->flush();

                    $this->addFlash('success', "Le role de l'utilisateur $infos a été modifié avec succès.");

                    return $this->redirectToRoute('app_admin_utilisateurs');
                }
            }
            else    // Sinon, aucun paramètres dans l'URL, alors on execute une requete de suppression
            {
                // dd('delete');
                $infos = $utilisateur->getPrenom() . " " . $utilisateur->getNom();

                $manager->remove($utilisateur);
                $manager->flush();

                $this->addFlash('succes', "Le rôle de l'utilisateur $infos a été supprimé avec succès.");

                return $this->redirectToRoute('app_admin_users');
            }
        }
        
        return $this->render('back_office/admin_users.html.twig', [
            'colonnes' => $colonnes,
            'users' => $utilisateurs,
            // Si l'indice dans l'URL est 'op=update' alors on execute createView() sur l'objet formUserUpdate pour générer le formulaire, sinon on stock une chaine de caractère vide.
            'formUserUpdate' => ($request->query->get('op') == 'update') ?$formUtilisateurUpdate->createView() : '',
            'user' => $utilisateur
        ]);
    }     
    



}

