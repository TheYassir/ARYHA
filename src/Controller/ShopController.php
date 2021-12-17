<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShopController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('shop/index.html.twig', [
           'titre' => 'Bienvenue sur World of Shoua',
        ]);
    }

    #[Route('/categorie', name:'categorie')]
    public function home(): Response
    {
        return $this->render('shop/categorie.html.twig', [
            
        ]);
    }
    
    #[Route('/shop', name: 'shop')]
    public function boutique(): Response
    {
        return $this->render('shop/shop.html.twig', [

            
        ]); 
    }
}
