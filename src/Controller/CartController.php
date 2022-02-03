<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Commande;
use App\Entity\DetailCommande;
use App\Repository\ArticleRepository;
use App\Repository\CommandeRepository;
use Doctrine\ORM\EntityManagerInterface;
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
    
    #[Route('/panier/achat', name: 'commander')]
    public function validPanier(SessionInterface $session, EntityManagerInterface $manager, ArticleRepository $articleRepo) : Response
    {   
        $panier = $session->get("panier", []);
        $commande = new Commande;
        $commande->setDate(new \DateTime());
        $commande->setUser($this->getUser());
        $commande->setEtat("En cours de traitement");
        $montant = 0;
        
        $panier = $session->get("panier", []);
        
        // On fabrique les données
        $dataPanier = [];
        $montant = 0;

        foreach($panier as $id => $quantite)
        {
            $article = $articleRepo->find($id);
            $dataPanier[] = [
                "article" => $article,
                "quantite" => $quantite
            ];
            $montant += $article->getPrix() * $quantite;
        }
        $commande->setMontant($montant);

        $manager->persist($commande);



        foreach($panier as $id => $quantite)
        {
            $articles = $articleRepo->find($id);
            $detailCommande = new DetailCommande;
            $detailCommande->setArticle($articles);
            $detailCommande->setQuantite($quantite);
            $prix = $articles->getPrix();
            $detailCommande->setPrix($prix);
            $detailCommande->setCommande($commande);
            $manager->persist($detailCommande);

        }
        $manager->flush();        
        $this->addFlash('success', "Félicitations ! Votre commande a été enregistré avec succès !");
        $session->remove('panier');
        

        return $this->redirectToRoute("home");
    }

    // #[Route('/panier/validation', name: 'valid')]
    // public function validation(CommandeRepository $repoCommande)
    // {      
    //     // $commande = $repoCommande->findOneBy(array("id" => "ASC"));
    //     $commande = $repoCommande->findBy(array('id' => 'Registration'),array('id' => 'ASC'),1 ,0)[0];
    //     // $commande = $repoCommande->findAll();
    //     dd($commande);
    //     return $this->render('shop/validation.html.twig', [
    //         'commande' => $commande
    //     ]);    
    
    // }
}
