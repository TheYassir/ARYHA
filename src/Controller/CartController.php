<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{
    #[Route('/panier', name: 'panier')]
    public function index(SessionInterface $session, ArticleRepository $articleRepo): Response
    {
        $panier = $session->get("panier", []);

        // On fabrique les données
        $dataPanier = [];
        $total = 0;

        foreach($panier as $id => $quantite)
        {
            $article = $articleRepo->find($id);
            $dataPanier[] = [
                "article" => $article,
                "quantite" => $quantite
            ];
            $total += $article->getPrix() * $quantite;
        
        }

        return $this->render('cart/index.html.twig',compact("dataPanier", "total"));
    }

    #[Route('/add/{id}', name: 'add_panier')]
    public function add(Article $article, SessionInterface $session)
    {
        // On récupere le panier actuel
        $panier = $session->get('panier', []);
        $id = $article->getId();

        if(!empty($panier[$id]))
        {
            $panier[$id] ++;
        } else {
            $panier[$id] = 1;
        }
        // On sauvegarde dans la Session
        $session->set('panier', $panier);
        
        return $this->redirectToRoute("panier");    
    }

    #[Route('/remove/{id}', name: 'remove_panier')]
    public function remove(Article $article, SessionInterface $session)
    {
        // On récupere le panier actuel
        $panier = $session->get('panier', []);
        $id = $article->getId();

        if(!empty($panier[$id]))
        {
            if($panier[$id] > 1)
            {
                $panier[$id]--;
            } else {
                unset($panier[$id]);
            }
        }
        // On sauvegarde dans la Session
        $session->set('panier', $panier);
        
        return $this->redirectToRoute("panier");    
    }

    #[Route('/delete/{id}', name: 'delete_panier')]
    public function delete(Article $article, SessionInterface $session)
    {
        // On récupere le panier actuel
        $panier = $session->get('panier', []);
        $id = $article->getId();

        if(!empty($panier[$id]))
        {
            unset($panier[$id]);
        }
        // On sauvegarde dans la Session
        $session->set('panier', $panier);
        
        return $this->redirectToRoute("panier");    
    }

    #[Route('/delete', name: 'delete_all_panier')]
    public function deleteAll(SessionInterface $session)
    {   
        $session->set('panier', []);
        
        return $this->redirectToRoute("panier");    
    }

}
