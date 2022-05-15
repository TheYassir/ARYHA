<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;
use App\Form\TailleType;
use App\Service\MailerService;
use App\Repository\TailleRepository;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use App\Repository\CodePromoRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ShopController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('shop/index.html.twig', [
           'titre' => 'Bienvenue sur ARYHA paris',
        ]);
    }

    #[Route('/contact', name: 'contact')]
    public function contact(Request $request, MailerService $mailer): Response
    {
        if($request->request->count() > 0 && $request->request->count() == 3 )
        {
            if(filter_var($request->request->get("email"), FILTER_VALIDATE_EMAIL)) 
            {
                if(strlen($request->request->get("subject")) >= 5)
                {
                    if(strlen($request->request->get("content")) >= 10)
                    {
                        $email = $request->request->get("email");
                        $subject = $request->request->get("subject");
                        $content = $request->request->get("content");
                        
                        $mailMessage = '<p>'. $email . ' vous a envoyer un message <br><br>Objet du message : '. $subject. '  <br><br> Contenu du message : '. $content. ' <br> </p>';
                        $mailer->sendEmail(content: $mailMessage, subject: "Un nouveau message d'un utilisateur !");

                        $this->addFlash('success', "Votre message à bien été envoyé");
                    } else {
                        $this->addFlash('danger', "Votre message n'est pas assez long !");
                    }
                } else {
                    $this->addFlash('danger', "Votre objet n'est pas assez long !");
                }
            } else {
                $this->addFlash('danger', "Votre mail n'est pas valide !");
            }

        }
        

        // $mailMessage = 'Nouvelle commande n°'.$commande->getId() . ' pour un montant de ' . $commande->getMontant() . ' € !';
        // $mailer->sendEmail(content: $mailMessage, subject: 'Une nouvelle commande !');
        
        

        return $this->render('shop/contact.html.twig');
    
    }

    #[Route('/home', name: 'home')]
    public function home(): Response
    {
        return $this->render('shop/home.html.twig');
    }

    public function allCategory(CategoryRepository $repoCategory)
    {
        $categorys = $repoCategory->findAll();
        $catHom = $repoCategory->findBy(array("sexe" => "Homme"));
        $catFem = $repoCategory->findBy(array("sexe" => "Femme"));
        return $this->render('shop/category_list.html.twig', [
            'categorys' => $categorys,
            'catHom' => $catHom,
            'catFem' => $catFem
        ]);
    }

    #[Route('/shop/{id}', name: 'shop_show')]
    public function ShopShow(Article $article, TailleRepository $repoTaille, Request $request): Response
    {
        // Cette ligne vérifie si la donnée $request à reçu une valeur ou plus en méthode POST
        if($request->request->count() > 0){
            // On récupère la valeur envoyer lors du choix de la taille 
            $taille = $request->request->get("taille");
            // On envoie l'utilisateur vers la route ajout au panier avec comme attribut l'article et la taille choisi 
            return $this->redirectToRoute('add_panier', [
                'id' => $article->getId(),
                'taille' => $taille 
            ]);    
        }
        // On récupère toute les tailles ayant une relation avec l'article 
        $cellules = $repoTaille->findBy(
            ['article' => $article]
        );
        // j'initialise un tableau vide
        $tabPhoto = [];
        // Et pour chaque donnée photo en BDD je vérifie si elle est null ou non 
        // et si elle contient une véritable photo je l'intègre à mon tableau 
        if($article->getPhoto() != Null && $article->getPhoto() != "null" )
        {
            $tabPhoto[] = $article->getPhoto();
        }
        if($article->getPhoto2() != Null && $article->getPhoto2() != "null" )
        {
            $tabPhoto[] = $article->getPhoto2();
        }
        if($article->getPhoto3() != Null && $article->getPhoto3() != "null" )
        {
            $tabPhoto[] = $article->getPhoto3();
        }
        if($article->getPhoto4() != Null && $article->getPhoto4() != "null" )
        {
            $tabPhoto[] = $article->getPhoto4();
        }
        if($article->getPhoto5() != Null && $article->getPhoto5() != "null" )
        {
            $tabPhoto[] = $article->getPhoto5();
        }
        if($article->getPhoto6() != Null && $article->getPhoto6() != "null" )
        {
            $tabPhoto[] = $article->getPhoto6();
        }
        // Maintenant que le tableau contient toutes les photos je l'envoi à la vue, avec les tailles et l'article lui-même
        return $this->render('shop/fiche-produit.html.twig', [
            'article' => $article,
            'cellules' => $cellules,
            'tabPhoto' => $tabPhoto
        ]);
    }

    #[Route('/shop', name: 'shop')]
    #[Route('/shop/category/{id}', name: 'shop_category')]
    public function Shop(SessionInterface $session, ArticleRepository $repoArticle, CodePromoRepository $repoCode, Category $category = null, Request $request): Response
    {
        $panier = $session->get("panier", []);
        if($request->request->get("codePromo") !== null )
        {
            if($session->get("codePromo") == null)
            {
                $code = $request->request->get("codePromo");
                $codePromo = $repoCode->findOneBy(
                    ['code' => $code]
                );
                if($codePromo){
                    $codePro = $codePromo->getId();
                    $promoCode = $session->set("codePromo", $codePro);
                    $request->request->set("codePromo", null) ;
                    $this->addFlash(
                        'danger',
                        'Il y a déja un code promo actif'
                     ); 
                } else {
                    $this->addFlash(
                        'danger',
                        'Ce code promo n\'existe pas'
                     );  
                }
                
            }
               
        }

        if($session->get("codePromo") != null){
            $idCodeSession = $session->get("codePromo");
            $codeSession = $repoCode->find($idCodeSession);
            $promo = $codeSession->getPromo();
            $promoFinal = 1 - ($promo/100);
        } else {
            $promo = 0;
            $codepro = 0;
        }


        // On fabrique les données
        $dataPanier = [];
        $total = 0;
        $nbPanier = 0;

        foreach($panier as $id => $taille)
        {
            $article = $repoArticle->find($id);
            foreach($taille as $quantite){

                $dataPanier[] = [
                    "article" => $article,
                    "taille" => $taille,
                    "quantite" => $quantite
                ];
            $total += $article->getPrix() * $quantite;
            $nbPanier +=  $quantite;

            }
        }
        $ancienTotal = $total;
        if($session->get("codePromo") != null)
        {
            $total = $total * $promoFinal ;
            $codepro = $total - $ancienTotal;
        }

        if ($category)
        {
            $articles = $category->getArticle();
        } else {
            $articles = $repoArticle->findAll();
        }

        return $this->render('shop/shop.html.twig', compact("dataPanier", "total", "articles", "category", "nbPanier", "promo", "codepro"));
    }

}
