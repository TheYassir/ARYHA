<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
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
        // dump($catHom);
        return $this->render('shop/category_list.html.twig', [
            'categorys' => $categorys,
            'catHom' => $catHom,
            'catFem' => $catFem
        ]);
    }

    #[Route('/shop/{id}', name: 'shop_show')]
    public function ShopShow(Article $article): Response
    {
        // $user = $this->getUser();
        // dd($article);
        return $this->render('shop/fiche-produit.html.twig', [
            'article' => $article
        ]);
    }

    #[Route('/shop', name: 'shop')]
    #[Route('/shop/category/{id}', name: 'shop_category')]
    #[Route('/shop/{sexe}', name: 'shop_genre')]
    public function Shop(SessionInterface $session, ArticleRepository $repoArticle, Category $category = null, $sexe = null): Response
    {

        $panier = $session->get("panier", []);

        // On fabrique les données
        $dataPanier = [];
        $total = 0;

        foreach($panier as $id => $quantite)
        {
            $article = $repoArticle->find($id);
            $dataPanier[] = [
                "article" => $article,
                "quantite" => $quantite
            ];
            $total += $article->getPrix() * $quantite;
            // dump($dataPanier);
        }

        if ($category)
        {
            $articles = $category->getArticle();
        }
        // elseif($sexe == "Homme")  {
        //     $articles = $repoArticle->getCategory();
        // }
        // elseif($sexe == "Femme")  {
        //     $articles = $repoArticle->getCategory();
        // }
        else {
            $articles = $repoArticle->findAll();
        }

        return $this->render('shop/shop.html.twig', compact("dataPanier", "total", "articles", "category"));
    }

<<<<<<< HEAD


=======
>>>>>>> db463e97081c5ebb2b85b40449c6df655ee01e58


}
