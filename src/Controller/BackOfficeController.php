<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Article;
use App\Entity\Commande;
use App\Form\ArticleType;
use App\Form\CommandeType;
use App\Controller\ShopController;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use App\Repository\ArticleRepository;
use App\Repository\CommandeRepository;
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


    #[Route('/admin/commande', name: 'app_admin_commande')]
    #[Route('/admin/commande/{id}/delete', name: 'app_admin_commande_delete')]
    public function adminCommande(EntityManagerInterface $manager, CommandeRepository $repoCom, Commande $comDelete = null)
    {

        $colonnes = $manager->getclassMetadata(Commande::class)->getFieldNames();

        $cellules = $repoCom->findAll();

        if($comDelete)
        {
            $comId = $comDelete->getId();

            if($comDelete->getDetailCommande())
            {
                $manager->remove($comDelete);
                $manager->flush();

                $this->addFlash('success', "La commande n°$comId a bien été supprimé avec succès.");
            }
            else
            {
                $this->addFlash('danger', "Impossible de supprimer la commande n°$comId car il y a encore des details associés");
            }

            return $this->redirectToRoute('app_admin_commande');
        }

        return $this->render('back_office/admin_commande.html.twig', [
            'colonnes' => $colonnes,
            'cellules' => $cellules
        ]);
        
        
    }
    
    #[Route('/admin/commande/{id}/edit', name: 'app_admin_commande_update')]
    public function adminCommandeForm(Commande $commande, Request $request, EntityManagerInterface $manager): Response
    {
 
        $formEtatCom = $this->createForm(CommandeType::class, $commande);
        $formEtatCom->handleRequest($request);
        $etatCom = $commande->getEtat();

            if($formEtatCom->isSubmitted() && $formEtatCom->isValid())
            {         
                $manager->persist($commande);
                $manager->flush();
                $etatCom2 = $commande->getEtat();
                $idCommande = $commande->getId();
                $this->addFlash('success', "La commande n°$idCommande été modifié avec succès de '$etatCom' à '$etatCom2'.");
                return $this->redirectToRoute('app_admin_commande');         
            }        

        return $this->render('back_office/admin_commande_form.html.twig', [
            'formEtatCom' => $formEtatCom->createView(),
            'commande' => $commande
        ]);
    }

    #[Route('/admin/user', name: 'app_admin_user')]
    #[Route('/admin/user/{id}/delete', name: 'app_admin_user_delete')]
    public function adminUser(EntityManagerInterface $manager, UserRepository $repoUser, User $userDelete = null): Response
    {
        $colonnes = $manager->getclassMetadata(User::class)->getFieldNames();
        $cellules = $repoUser->findAll();

        if($userDelete)
        {
            $id = $userDelete->getId();
            $manager->remove($userDelete);
            $manager->flush();
            $this->addFlash('success', "L'Utilisateur n°$id a bien été supprimer avec succès");
            return $this->redirectToRoute('app_admin_user');
        }
        return $this->render('back_office/admin_user.html.twig', [
            'colonnes' => $colonnes,
            'cellules' => $cellules,
        ]);
    }

    #[Route('/admin/user/{id}/edit', name: 'app_admin_user_update')]
    public function adminUserForm(User $user, Request $request, EntityManagerInterface $manager): Response
    {
 
        $formAdminUser = $this->createForm(RegistrationFormType::class, $user, [
            'userUpdateBack' => true 
        ]);

        $formAdminUser->handleRequest($request);

            if($formAdminUser->isSubmitted() && $formAdminUser->isValid())
            {         
                $manager->persist($user);
                $manager->flush();

                $idComment = $user->getId();

                $this->addFlash('success', "Le commentaire n°$idComment été ajouté avec succès !");

                return $this->redirectToRoute('app_admin_user');         
            
            }        

        return $this->render('back_office/admin_user_form.html.twig', [
            'formAdminUser' => $formAdminUser->createView(),
            'user' => $user
        ]);
    }

}

