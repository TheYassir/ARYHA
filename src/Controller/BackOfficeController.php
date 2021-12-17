<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Article;
use App\Form\ArticleType;
use App\Controller\ShopController;
use App\Repository\UserRepository;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
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
    #[Route('/admin/articles/{id}/remove', name: 'app_admin_articles_delete')]
    public function adminArticles(EntityManagerInterface $manager, ArticleRepository $repoArticle, Article $artDelete = null, ShopController $artUpdate): Response
    {
        $colonnes = $manager->getclassMetadata(Article::class)->getFieldNames();
        $cellules = $repoArticle->findAll();

        if($artDelete)
        {
            $id = $artDelete->getId();
            $manager->remove($artDelete);
            $manager->flush();
            $this->addFlash('success', "L'article n°$id a bien été supprimer avec succès");
            return $this->redirectToRoute('app_admin_articles');
        }
        return $this->render('back_office/admin_articles.html.twig', [
            'colonnes' => $colonnes,
            'cellules' => $cellules
        ]);
    }


    #[Route('/admin/articles/add', name: 'app_admin_articles_add')]
    #[Route('/admin/articles/{id}/edit', name: 'app_admin_articles_update')]
    public function adminArticleForm(Article $article = null, Request $request, EntityManagerInterface $manager, SluggerInterface $slugger): Response
    {
        if($article)
        {
            $photoActuelle = $article->getPhoto();
        }

        if(!$article)
        {
            $article = new Article;
        }
        
        $formArticle = $this->createForm(ArticleType::class, $article);
        $formArticle->handleRequest($request);


        if($formArticle->isSubmitted() && $formArticle->isValid())
        {
            if(!$article->getId())
                $txt = "enregistré";
            else
                $txt = "modifier";

            if($article->getId())
            $photo = $formArticle->get('photo')->getData();

            if($photo)
            {
                $nomOriginePhoto = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
                $nouveauNomFichier = $nomOriginePhoto . "-" . uniqid() . '.' . $photo->guessExtension();              
                try
                {
                    $photo->move(
                        $this->getParameter('photo_directory'),
                        $nouveauNomFichier
                    );
                }
                catch(FileException $e)
                {

                }
                $article->setPhoto($nouveauNomFichier);
            }
            else
            {
                if(isset($photoActuelle))
                    $article->setPhoto($photoActuelle);
                else
                    $article->setPhoto("null");
            }
            $manager->persist($article);
            $manager->flush();
            $this->addFlash('success', "L'article a été $txt avec succès !");

            return $this->redirectToRoute('app_admin_articles', [
                'id' => $article->getId()
            ]);           
        }
        return $this->render('back_office/admin_articles_form.html.twig', [
            'formArticle' => $formArticle->createView(),
            'editMode' => $article->getId(),
            'photoActuelle' => $article->getPhoto()
        ]);
    }





    // Affichage et suppression des Users

// USERS

    // #[Route('/admin/user', name: 'app_admin_user')] // Affichage des users
    // #[Route('/admin/user/{id}/update', name: 'app_admin_user_update')] // modification
    // #[Route('/admin/user/{id}/remove', name: 'app_admin_user_remove')] // suppression
    // public function adminUsers(EntityManagerInterface $manager, UserRepository $repoUtilisateur, User $user = null, Request $request): Response
    // {
    //     //dd($user);
    //     //dd($request->query);

    //     $colonnes = $manager->getClassMetadata(User::class)->getFieldNames();
    //     // dd($colonnes);

    //     $user = $repoUtilisateur->findAll();
    //     //dd($user);

    //     // Si $user retourne true, cela veut que $user les informations d'1 user stocké en BDD
    //     if($user)
    //     {
    //         // Si l'indice 'op' est définit dans l'URL et qu'il a pour valeur 'update', alors on entre dans la condition et on execute une requete 'update'.
    //         if($request->query->get('op') == 'update')
    //         {
    //             // dd('update');
    //             $formUtilisateurUpdate = $this->createForm(RegistrationFormType::class, $user, [
    //                 'userUpdateBack' => true
    //             ]);

    //             $formUtilisateurUpdate->handleRequest($request);

    //             if($formUtilisateurUpdate->isSubmitted() && $formUtilisateurUpdate->isValid())
    //             {
    //                 $infos = $user->getPrenom() . " " . $user->getNom();

    //                 $manager->persist($user);
    //                 $manager->flush();

    //                 $this->addFlash('success', "Le role de l'utilisateur $infos a été modifié avec succès.");

    //                 return $this->redirectToRoute('app_admin_utilisateurs');
    //             }
    //         }
    //         else    // Sinon, aucun paramètres dans l'URL, alors on execute une requete de suppression
    //         {
    //             // dd('delete');
    //             $infos = $user->getPrenom() . " " . $user->getNom();

    //             $manager->remove($user);
    //             $manager->flush();

    //             $this->addFlash('succes', "Le rôle de l'utilisateur $infos a été supprimé avec succès.");

    //             return $this->redirectToRoute('app_admin_users');
    //         }
    //     }
        
    //     return $this->render('back_office/admin_users.html.twig', [
    //         'colonnes' => $colonnes,
    //         'users' => $user,
    //         // Si l'indice dans l'URL est 'op=update' alors on execute createView() sur l'objet formUserUpdate pour générer le formulaire, sinon on stock une chaine de caractère vide.
    //         'formUserUpdate' => ($request->query->get('op') == 'update') ?$formUtilisateurUpdate->createView() : '',
    //         'user' => $user
    //     ]);
    // }     
    




}

