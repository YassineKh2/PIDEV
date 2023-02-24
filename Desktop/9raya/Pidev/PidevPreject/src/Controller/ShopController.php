<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class ShopController extends AbstractController
{
    #[Route('/shop', name: 'app_shop')]
    public function index(CategorieRepository $categorieRepository,ArticleRepository $ArticleRepository): Response
    {
        return $this->render('shop/index.html.twig', [
            'categories' => $categorieRepository->findAll(),
            'articles' => $ArticleRepository->Find10First(),
        ]);
    }
    #[Route('/shop/categorie/{id}', name: 'app_articles')]
    public function afficherArticles(ArticleRepository $ArticleRepository,$id): Response
    {
        return $this->render('shop/showLesArticles.html.twig', [
            'articles' => $ArticleRepository->FindArticleByIdCategorie($id),
        ]);
    }
    #[Route('/shop/article/{id}', name: 'app_article')]
    public function afficherArticle(ArticleRepository $ArticleRepository,$id): Response
    {
        $article = $ArticleRepository->findBy(array('id' => $id))[0];
        return $this->render('shop/showSingleArticle.html.twig', [
            'article' => $article,
            'articles' => $ArticleRepository->FindArticleByIdCategorie($article->getCategorie()->getId()),
        ]);
    }
    #[Route('/shop/article/ajouter/{id}/{quantity}', name: 'app_article_ajouter_panier')]
    public function ajouterPainner(SessionInterface $session,$id,$quantity,ArticleRepository $articleRep) : Response
    {

       // $session->clear();
        $panier =  $session->get('panier',[]);

        $quantity = intval($quantity);
        if(!empty($panier[$id]))
             $panier[$id] +=$quantity;
        else
            $panier[$id] = $quantity;


        $session->set('panier',$panier);
        $article = $articleRep->find($id);
        $categorie = $article->getCategorie()->getId();
       return $this->redirectToRoute('app_articles',[
           'id' => $categorie
       ]);
    }
    #[Route('/shop/panier', name: 'app_article_afficher_panier')]
    public function ShowPannier(SessionInterface $session,ArticleRepository $articleRep) : Response
    {
        $panier =  $session->get('panier',[]);
        $pannierWithData = [];

        foreach($panier as $id => $quantity){
            $pannierWithData[] = [
            'article' => $articleRep->find($id),
            'quantity' => $quantity
            ];
        }
        return $this->render("shop/panier.html.twig", [
        "Pannier" => $pannierWithData
        ]);
    }
    #[Route('/shop/panier/remove/{id}', name: 'app_article_remove_from_panier')]
    public function RemoveArticle(SessionInterface $session,$id) : Response
    {
        $panier =  $session->get('panier',[]);
            if(!empty($panier[$id]))
                unset($panier[$id]);

        $session->set('panier',$panier);

           return $this->redirectToRoute('app_article_afficher_panier');
    }
}
