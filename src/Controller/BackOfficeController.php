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
        // PROBleme ici car NULL en base de donnée a la pace de string les changer
        if($article)
        {
            $photoActuelle = $article->getPhoto();
            $photoActuelle2 = $article->getPhoto2();
            $photoActuelle3 = $article->getPhoto3();
            $photoActuelle4 = $article->getPhoto4();
            $photoActuelle5 = $article->getPhoto5();
            $photoActuelle6 = $article->getPhoto6();
            if($article->getPhoto() == Null){
                $article->setPhoto('null');
            }
            if($article->getPhoto2() == Null){
                $article->setPhoto2('null');
            }
            if($article->getPhoto3() == Null){
                $article->setPhoto3('null');
            }
            if($article->getPhoto4() == Null){
                $article->setPhoto4('null');
            }
            if($article->getPhoto5() == Null){
                $article->setPhoto5('null');
            }
            if($article->getPhoto6() == Null){
                $article->setPhoto6('null');
            }

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
            $photo2 = $formArticle->get('photo2')->getData();
            $photo3 = $formArticle->get('photo3')->getData();
            $photo4 = $formArticle->get('photo4')->getData();
            $photo5 = $formArticle->get('photo5')->getData();
            $photo6 = $formArticle->get('photo6')->getData();


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

            if($photo2)
            {

                $nomOriginePhoto2 = pathinfo($photo2->getClientOriginalName(), PATHINFO_FILENAME);
                $nouveauNomFichier2 = $nomOriginePhoto2 . "-" . uniqid() . '.' . $photo2->guessExtension();              
                try
                {
                    $photo2->move(
                        $this->getParameter('photo_directory'),
                        $nouveauNomFichier2
                    );
                }
                catch(FileException $e)
                {

                }
                $article->setPhoto2($nouveauNomFichier2);
            }
            else
            {
                if(isset($photoActuelle2))
                    $article->setPhoto2($photoActuelle2);
                else
                    $article->setPhoto2("null");
            }

            if($photo3)
            {
                $nomOriginePhoto3 = pathinfo($photo3->getClientOriginalName(), PATHINFO_FILENAME);
                $nouveauNomFichier3 = $nomOriginePhoto3 . "-" . uniqid() . '.' . $photo3->guessExtension();              
                try
                {
                    $photo3->move(
                        $this->getParameter('photo_directory'),
                        $nouveauNomFichier3
                    );
                }
                catch(FileException $e)
                {

                }
                $article->setPhoto3($nouveauNomFichier3);
            }
            else
            {
                if(isset($photoActuelle3))
                    $article->setPhoto3($photoActuelle3);
                else
                    $article->setPhoto3("null");
            }

            if($photo4)
            {
                $nomOriginePhoto4 = pathinfo($photo4->getClientOriginalName(), PATHINFO_FILENAME);
                $nouveauNomFichier4 = $nomOriginePhoto4 . "-" . uniqid() . '.' . $photo4->guessExtension();              
                try
                {
                    $photo4->move(
                        $this->getParameter('photo_directory'),
                        $nouveauNomFichier4
                    );
                }
                catch(FileException $e)
                {

                }
                $article->setPhoto4($nouveauNomFichier4);
            }
            else
            {
                if(isset($photoActuelle4))
                    $article->setPhoto4($photoActuelle4);
                else
                    $article->setPhoto4("null");
            }

            if($photo5)
            {
                $nomOriginePhoto5 = pathinfo($photo5->getClientOriginalName(), PATHINFO_FILENAME);
                $nouveauNomFichier5 = $nomOriginePhoto5 . "-" . uniqid() . '.' . $photo5->guessExtension();              
                try
                {
                    $photo5->move(
                        $this->getParameter('photo_directory'),
                        $nouveauNomFichier5
                    );
                }
                catch(FileException $e)
                {

                }
                $article->setPhoto5($nouveauNomFichier5);
            }
            else
            {
                if(isset($photoActuelle5))
                    $article->setPhoto5($photoActuelle5);
                else
                    $article->setPhoto5("null");
            }

            if($photo6)
            {
                $nomOriginePhoto6 = pathinfo($photo6->getClientOriginalName(), PATHINFO_FILENAME);
                $nouveauNomFichier6 = $nomOriginePhoto6 . "-" . uniqid() . '.' . $photo6->guessExtension();              
                try
                {
                    $photo6->move(
                        $this->getParameter('photo_directory'),
                        $nouveauNomFichier6
                    );
                }
                catch(FileException $e)
                {

                }
                $article->setPhoto6($nouveauNomFichier6);
            }
            else
            {
                if(isset($photoActuelle6))
                    $article->setPhoto6($photoActuelle6);
                else
                    $article->setPhoto6("null");
            }

            $manager->persist($article);
            if(!$article->getId())
            {
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
            }
            $manager->flush();

            if(!$article->getId())
            {
                return $this->redirectToRoute('app_admin_taille', [
                    'id' => $article->getId(),
                ]); 
            } else {
                $this->addFlash('success', "L'article a été $txt avec succès !");
                return $this->redirectToRoute('app_admin_articles');
            }
                
        }
        return $this->render('back_office/admin_articles_form.html.twig', [
            'formArticle' => $formArticle->createView(),
            'editMode' => $article->getId(),
            'photoActuelle' => $article->getPhoto(),
            'photoActuelle2' => $article->getPhoto2(),
            'photoActuelle3' => $article->getPhoto3(),
            'photoActuelle4' => $article->getPhoto4(),
            'photoActuelle5' => $article->getPhoto5(),
            'photoActuelle6' => $article->getPhoto6()

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

