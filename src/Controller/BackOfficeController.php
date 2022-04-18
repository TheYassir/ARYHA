<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Article;
use App\Entity\Category;
use App\Entity\CodePromo;
use App\Entity\Commande;
use App\Form\ArticleType;
use App\Form\CategoryType;
use App\Form\CommandeType;
use App\Entity\Taille;
use App\Form\CodePromoType;
use App\Form\RegistrationFormType;
use App\Form\TailleType;
use App\Repository\UserRepository;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use App\Repository\CodePromoRepository;
use App\Repository\CommandeRepository;
use App\Repository\DetailCommandeRepository;
use App\Repository\TailleRepository;
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
    public function adminArticles(EntityManagerInterface $manager, ArticleRepository $repoArticle, Article $artDelete = null, TailleRepository $repoTail): Response
    {
        // Pour récupérer tout les noms des champs inscris en BDD
        $colonnes = $manager->getclassMetadata(Article::class)->getFieldNames();
        // Pour récupérer tout les articles sans distinction
        $cellules = $repoArticle->findAll();

        $toutTailles = $repoTail->findAll();

        // $tab = array("39"=>"10", "40"=>"20", "41"=>"30");
        // foreach($tab as $key => $value)
        // {
        // dump($cellules);
        // }

        // dd($tab);
        // Si un ID est envoyer en URL, il est récuperer automatiquement dans la variable artDelete
        if($artDelete)
        {
            // Grace à l'id on récupère l'article au complet 
            $id = $artDelete->getId();
            // On le supprime 
            $manager->remove($artDelete);
            // Et on flush, on execute la suppression
            $manager->flush();
            // On enregistre un message en session quon pourra afficher
            $this->addFlash('success', "L'article n°$id a bien été supprimer avec succès");
            return $this->redirectToRoute('app_admin_articles');
        }
        // Envoi un template a afficher avec des valeur données pour pouvoir afficher se que l'on veut précisement ici les titre et les article au complet 
        return $this->render('back_office/admin_articles.html.twig', [
            'colonnes' => $colonnes,
            'cellules' => $cellules,
            'toutTail' => $toutTailles
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
            

            if($article->getCategory()->getGrdCat() == "Souliers")
            {
                $tab = [37, 38, 39, 40, 41, 42, 43, 44, 45];
                foreach($tab as $value){
                    $taille = new Taille;
                    $taille->setTitre($value);
                    $taille->setStock("0");
                    $taille->setArticle($article);
                    $manager->persist($taille);
                }
                

            } elseif($article->getCategory()->getGrdCat() == "Prêt-à-porter") 
            {
                $tab = ["XS", "S", "M", "L", "XL"];

                foreach($tab as $value){
                    $taille = new Taille;
                    $taille->setTitre($value);
                    $taille->setStock("0");
                    $taille->setArticle($article);
                    $manager->persist($taille);
                }

            } else 
            {
                
                $this->addFlash('success', "L'article a été $txt avec succès !");
                $taille = new Taille;
                $taille->setTitre("Unique");
                $taille->setStock("0");
                $taille->setArticle($article);
                $manager->persist($taille);
            }
            $manager->flush();

            return $this->redirectToRoute('app_admin_taille', [
                'id' => $article->getId(),
            ]);  
            
            // return $this->redirectToRoute('app_admin_articles', [
            //     'id' => $article->getId()
            // ]); 
                    
        }
        return $this->render('back_office/admin_articles_form.html.twig', [
            'formArticle' => $formArticle->createView(),
            'editMode' => $article->getId(),
            'photoActuelle' => $article->getPhoto()
        ]);
    }


    #[Route('/admin/commande', name: 'app_admin_commande')]
    #[Route('/admin/commande/{id}/delete', name: 'app_admin_commande_delete')]
    public function adminCommande(EntityManagerInterface $manager, CommandeRepository $repoCom, Commande $comDelete = null, DetailCommandeRepository $repoDet)
    {

        $colonnes = $manager->getclassMetadata(Commande::class)->getFieldNames();

        $cellules = $repoCom->findAll();

        $detailCommande = $repoDet->findAll();


        if($comDelete)
        {
            $comId = $comDelete->getId();

            if($comDelete->getDetailCommande())
            {
                $manager->remove($comDelete);
                $manager->flush();


                $this->addFlash('success', "La commande n°$comId a bien été supprimé avec succès.");
            }
            else
            {
                $this->addFlash('danger', "Impossible de supprimer la commande n°$comId car il y a encore des details associés");
            }

            return $this->redirectToRoute('app_admin_commande');
        }
        
        return $this->render('back_office/admin_commande.html.twig', [
            'colonnes' => $colonnes,
            'cellules' => $cellules,
            'detailCommande' => $detailCommande
        ]);
        
        
    }

    #[Route('/admin/commande/{id}/edit', name: 'app_admin_commande_update')]
    public function adminCommandeForm(Commande $commande, Request $request, EntityManagerInterface $manager, DetailCommandeRepository $repoDet): Response
    {
        $detailCommande = $repoDet->findAll();
        $formEtatCom = $this->createForm(CommandeType::class, $commande);
        $formEtatCom->handleRequest($request);
        $etatCom = $commande->getEtat();


            if($formEtatCom->isSubmitted() && $formEtatCom->isValid())
            {         
                $manager->persist($commande);
                $manager->flush();
                $etatCom2 = $commande->getEtat();
                $idCommande = $commande->getId();
                $this->addFlash('success', "La commande n°$idCommande été modifié avec succès de '$etatCom' à '$etatCom2'.");
                return $this->redirectToRoute('app_admin_commande');         
            }        

        return $this->render('back_office/admin_commande_form.html.twig', [
            'formEtatCom' => $formEtatCom->createView(),
            'commande' => $commande,
            'detailCommande' => $detailCommande
        ]);
    }

    #[Route('/admin/user', name: 'app_admin_user')]
    #[Route('/admin/user/{id}/delete', name: 'app_admin_user_delete')]
    public function adminUser(EntityManagerInterface $manager, UserRepository $repoUser, User $userDelete = null): Response
    {
        $colonnes = $manager->getclassMetadata(User::class)->getFieldNames();
        $cellules = $repoUser->findAll();


        if($userDelete)
        {
            $id = $userDelete->getId();
            $manager->remove($userDelete);
            $manager->flush();
            $this->addFlash('success', "L'Utilisateur n°$id a bien été supprimer avec succès");
            return $this->redirectToRoute('app_admin_user');
        }
        return $this->render('back_office/admin_user.html.twig', [
            'colonnes' => $colonnes,
            'cellules' => $cellules,
        ]);
    }

    #[Route('/admin/user/{id}/edit', name: 'app_admin_user_update')]
    public function adminUserForm(User $user, Request $request, EntityManagerInterface $manager): Response
    {
 
        $formAdminUser = $this->createForm(RegistrationFormType::class, $user, [
            'userUpdateBack' => true 
        ]);

        $formAdminUser->handleRequest($request);

            if($formAdminUser->isSubmitted() && $formAdminUser->isValid())
            {         
                $manager->persist($user);
                $manager->flush();

                $idComment = $user->getId();

                $this->addFlash('success', "Le commentaire n°$idComment été ajouté avec succès !");

                return $this->redirectToRoute('app_admin_user');         
            
            }        

        return $this->render('back_office/admin_user_form.html.twig', [
            'formAdminUser' => $formAdminUser->createView(),
            'user' => $user
        ]);
    }

    #[Route('/admin/category', name: 'app_admin_category')]
    #[Route('/admin/category/{id}/delete', name: 'app_admin_category_delete')]
    public function adminCategory(EntityManagerInterface $manager, CategoryRepository $repoCat, Category $catDelete = null): Response
    {
        $colonnes = $manager->getclassMetadata(Category::class)->getFieldNames();
        $cellules = $repoCat->findAll();


        if($catDelete)
        {
            $id = $catDelete->getId();
            $manager->remove($catDelete);
            $manager->flush();
            $this->addFlash('success', "La Category n°$id a bien été supprimer avec succès");
            return $this->redirectToRoute('app_admin_category');
        }
        return $this->render('back_office/admin_category.html.twig', [
            'colonnes' => $colonnes,
            'cellules' => $cellules,
        ]);
    }

    #[Route('/admin/category/add', name: 'app_admin_category_add')]
    #[Route('/admin/category/{id}/edit', name: 'app_admin_category_update')]
    public function adminCatgoryForm(Category $category = null, Request $request, EntityManagerInterface $manager): Response
    {
        if(!$category)
        {
            $category = new Category;
        }
        
        $formCat = $this->createForm(CategoryType::class, $category);
        $formCat->handleRequest($request);


        if($formCat->isSubmitted() && $formCat->isValid())
        {
            if(!$category->getId())
                $txt = "enregistré";
            else
                $txt = "modifier";

            $manager->persist($category);
            $manager->flush();
            $this->addFlash('success', "La Category a été $txt avec succès !");

            return $this->redirectToRoute('app_admin_category', [
                'id' => $category->getId()
            ]);           
        }
        return $this->render('back_office/admin_category_form.html.twig', [
            'formCat' => $formCat->createView(),
            'editMode' => $category->getId(),
        ]);
    }

    #[Route('/admin/taille/{id}', name: 'app_admin_taille')]
    public function tailleAffiche(Article $article, TailleRepository $repoTaille)
    {
        $cellules = $repoTaille->findBy(
            ['article' => $article]
        );
    
        return $this->render('back_office/admin_taille.html.twig', [
            'cellules' => $cellules,
            'editMode' => $article->getId(),
        ]);
    }

    #[Route('/admin/taille/edit/{id}', name: 'app_admin_taille_update')]
    public function tailleForm(Taille $taille, Request $request, EntityManagerInterface $manager): Response
    {
        // $formTaille = $this->createForm(TailleType::class, $taille);
        $formTaille = $this->createForm(TailleType::class, $taille);
        $formTaille->handleRequest($request);


        if($formTaille->isSubmitted() && $formTaille->isValid())
        {         
            $manager->persist($taille);
            $manager->flush();
            $this->addFlash('success', "Le stock du produit a été mis à jour !");


            return $this->redirectToRoute('app_admin_taille', [
                'id' => $taille->getArticle()->getId(),
                'editMode' => $taille->getId(),
            ]);      
        
        }        

        
        return $this->render('back_office/admin_taille_form.html.twig', [
            'formTaille' => $formTaille->createView(),
            'taille' => $taille,
            'editMode' => $taille->getId(),
        ]);
    }

    #[Route('/admin/codePromo', name: 'app_admin_codePromo')]
    #[Route('/admin/codePromo/{id}/delete', name: 'app_admin_codePromo_delete')]
    public function adminCodePromo(EntityManagerInterface $manager, CodePromoRepository $repoCode, CodePromo $codeDelete = null): Response
    {
        // $colonnes = $manager->getclassMetadata(Category::class)->getFieldNames();
        $cellules = $repoCode->findAll();


        if($codeDelete)
        {
            $id = $codeDelete->getId();
            $manager->remove($codeDelete);
            $manager->flush();

            $this->addFlash('success', "Le Code Promo n°$id a bien été supprimer avec succès");

            return $this->redirectToRoute('app_admin_codePromo');
        }
        return $this->render('back_office/admin_codePromo.html.twig', [
            // 'colonnes' => $colonnes,
            'cellules' => $cellules,
        ]);
    }

    #[Route('/admin/codePromo/add', name: 'app_admin_codePromo_add')]
    #[Route('/admin/codePromo/{id}/edit', name: 'app_admin_codePromo_update')]
    public function adminCodePromoForm(CodePromo $codePromo = null, Request $request, EntityManagerInterface $manager): Response
    {
        if(!$codePromo)
        {
            $codePromo = new CodePromo;
        }
        
        $formCode = $this->createForm(CodePromoType::class, $codePromo);
        $formCode->handleRequest($request);


        if($formCode->isSubmitted() && $formCode->isValid())
        {
            if(!$codePromo->getId())
                $txt = "enregistré";
            else
                $txt = "modifier";

            $manager->persist($codePromo);
            $manager->flush();
            $this->addFlash('success', "Le Code Promo a été $txt avec succès !");
    
            return $this->redirectToRoute('app_admin_codePromo', [
                'id' => $codePromo->getId()
            ]);
        }
        return $this->render('back_office/admin_codePromo_form.html.twig', [
            'formCode' => $formCode->createView(),
            'editMode' => $codePromo->getId(),
        ]);
    }
}

