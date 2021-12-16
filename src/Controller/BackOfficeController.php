<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Controller\ShopController;
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
               $article->setDate(new \DateTime());

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
}
