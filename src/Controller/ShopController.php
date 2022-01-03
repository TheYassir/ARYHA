<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
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
        // dd($categorys);
        return $this->render('shop/category_list.html.twig', [
            'categorys' => $categorys
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
    public function Shop(ArticleRepository $repoArticle, Category $category = null, $sexe = null): Response
    {

        if ($category)
        {
            $articles = $category->getArticle();
        }
        # elseif($sexe)  {
        # $articles = $repository->findBy(
        # ['name' => 'Keyboard'],
        # ['price' => 'ASC']
        # );
        # $articles = $repository->findAll();
        # }
        else {
            $articles = $repoArticle->findAll();
        }

        return $this->render('shop/shop.html.twig', [
            'articles' => $articles,
        ]);
    }

    #[Route('/panier', name: 'panier')]
    public function panier(): Response
    {
        return $this->render('shop/panier.html.twig', [

        ]);
    }

    


}
