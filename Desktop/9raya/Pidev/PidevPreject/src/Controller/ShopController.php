<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
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
}
