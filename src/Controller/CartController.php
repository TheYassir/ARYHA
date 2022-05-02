<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Commande;
use App\Entity\DetailCommande;
use App\Service\MailerService;
use App\Repository\TailleRepository;
use App\Repository\ArticleRepository;
use App\Repository\CodePromoRepository;
use App\Repository\CommandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{
    #[Route('/panier', name: 'panier')]
    public function index(SessionInterface $session, ArticleRepository $articleRepo, CodePromoRepository $repoCode, TailleRepository $tailleRepo, Request $request): Response
    {
        $panier = $session->get("panier", []);
        if($session->get("codePromo") != null){
            $idCodeSession = $session->get("codePromo");
            $codeSession = $repoCode->find($idCodeSession);
            // dd($session);
            $promo = $codeSession->getPromo();
            $promoFinal = 1 - ($promo / 100);
        } else {
            $promo = 0;
            $codepro = 0;

        }
        // On fabrique les données
        $dataPanier = [];
        $total = 0;

        foreach($panier as $id => $data)
        {
            $article = $articleRepo->find($id);
            foreach($data as $taille => $quantite){
                // $taille = $tailleRepo->findBy(['article' => $article]);
                $dataPanier[] = [
                    "article" => $article,
                    "taille" => $taille,
                    "quantite" => $quantite,
                ];
            
            $total += $article->getPrix() * $quantite;

            }
        }
        $ancienTotal = $total;
        if($session->get("codePromo") != null)
        {
            $total = $total * $promoFinal ;
            $codepro = $total - $ancienTotal;
        }
       
        return $this->render('cart/index.html.twig',compact("dataPanier", "total", "promo","codepro"));
    }


    #[Route('/add/{id}/{taille}', name: 'add_panier')]
    public function add(Article $article, SessionInterface $session, Request $request)
    {
        $taille = $request->attributes->get("taille");

        // dd($taille);
        // On récupere le panier actuel
        $panier = $session->get('panier', []);
        $id = $article->getId();

        if(!empty($panier[$id]))
        {
            if(!empty($panier[$id][$taille]))
            {
                $panier[$id][$taille] ++;
            } else {
                $panier[$id][$taille] = 1;
            }
        } else {
            $panier[$id] = array();
            $panier[$id][$taille] = 1;
        }
        // On sauvegarde dans la Session
        $session->set('panier', $panier);
        // dd($panier);
        return $this->redirectToRoute("panier");    
    }

    #[Route('/remove/{id}/{taille}', name: 'remove_panier')]
    public function remove(Article $article, SessionInterface $session, Request $request)
    {
        $taille = $request->attributes->get("taille");
        // On récupere le panier actuel
        $panier = $session->get('panier', []);
        $id = $article->getId();

        if(!empty($panier[$id]))
        {
            if(!empty($panier[$id][$taille]))
            {
                $panier[$id][$taille] --;
            } else {
                unset($panier[$id][$taille]);
            }
        } else {
            unset($panier[$id][$taille]);
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
    public function validPanier(SessionInterface $session, EntityManagerInterface $manager, CodePromoRepository $repoCode, ArticleRepository $articleRepo, TailleRepository $tailleRepo, MailerService $mailer) : Response
    {   
        if($session->get("codePromo") != null){
            $idCodeSession = $session->get("codePromo");
            $codeSession = $repoCode->find($idCodeSession);
            // dd($session);
            $promo = $codeSession->getPromo();
            $promoFinal = 1 - ($promo/100);
        }
        if($session->get("panier", [])){
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

            foreach($panier as $id => $data)
            {
                $article = $articleRepo->find($id);
                foreach($data as $taille => $quantite){
                    $dataPanier[] = [
                        "article" => $article,
                        "taille" => $taille,
                        "quantite" => $quantite,
                    ];
                $montant += $article->getPrix() * $quantite;
                }
            }

            if($session->get("codePromo") != null)
            {
                $montant = $montant * $promoFinal ;
                $session->remove('codePromo');
            }

            $commande->setMontant($montant);
            $manager->persist($commande);

            foreach($panier as $id => $data)
            {
                $article = $articleRepo->find($id);
                foreach($data as $taille => $quantite){
                    
                    $laTaille = $tailleRepo->findOneBy(['article' => $article, 'titre' => $taille]);
                    $articles = $articleRepo->find($id);
                    $detailCommande = new DetailCommande;
                    $detailCommande->setArticle($articles);
                    $detailCommande->setTaille($laTaille);
                    $amel = $laTaille->getStock();
                    if($amel - $quantite >= 0){
                        $laTaille->setStock($amel - $quantite);
                    } else {
                        $this->addFlash('danger', "La quantité disponible de l'article ". $article->getTitre() . " est inférieur à celle demandée !( Stock : " . $amel ." )");
                        return $this->redirectToRoute("panier");
                    }
                    $detailCommande->setQuantite($quantite);
                    $prix = $articles->getPrix();
                    $detailCommande->setPrix($prix);
                    $detailCommande->setCommande($commande);
                    $manager->persist($detailCommande);
     
                $montant += $article->getPrix() * $quantite;

                }
            }
            $manager->flush();     
            $mailMessage = 'Nouvelle commande n°'.$commande->getId() . ' pour un montant de ' . $commande->getMontant() . ' € !';
            $mailer->sendEmail(content: $mailMessage, subject: 'Une nouvelle commande !');

            // $this->addFlash('success', "Félicitations ! Votre commande a été enregistré avec succès !");
            $session->remove('panier');
            

            return $this->redirectToRoute("valid");

        } else {
            $this->addFlash('danger', "Votre panier est vide");
            return $this->redirectToRoute("panier");
        }
        
    }


    #[Route('/panier/validation', name: 'valid')]
    public function validation(CommandeRepository $repoCommande)
    {      
        $commande = $repoCommande->findBy(array(), array('id' => 'desc'),1,0);
        
        // dd($commande);
        return $this->render('cart/validation.html.twig', [
            'commande' => $commande
        ]);    
    
    }
}
