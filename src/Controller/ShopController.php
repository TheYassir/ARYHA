<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ShopController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('shop/index.html.twig', [
           'titre' => 'Bienvenue sur World of Shoua',
        ]);
    }
    
    #[Route('/home', name: 'home')]
    public function home(): Response
    {
        return $this->render('shop/home.html.twig');
    }

    #[Route('/boutique', name: 'boutique')]
    #[Route('/boutique/produit/{id}', name: 'boutique_produit')]
    public function boutique(ArticleRepository $repoArticle): Response
    {

        $articles = $repoArticle->findAll();

        return $this->render('shop/shop.html.twig', [
            'articles' => $articles
        ]); 
    }

    #[Route('/ficheProduit', name: 'fiche-produit')]
    public function ficheProduit(): Response
    {
        return $this->render('shop/fiche-produit.html.twig');
    }
}
