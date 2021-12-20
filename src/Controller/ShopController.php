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

    public function shop(ArticleRepository $repoArticle)
    {
        $shop = $repoArticle->findAll();

        return $this->render('shop/shop.html.twig', [
            'shop' => $shop
        ]); 
    }

    #[Route('/categorie', name:'categorie')]
    public function home(): Response
    {
        return $this->render('shop/categorie.html.twig', [
            
        ]);
    }
    
    

    #[Route('/panier', name: 'panier')]
    public function panier(): Response
    {
        return $this->render('shop/panier.html.twig', [

        ]); 
    }
}
