<?php

namespace Application\Controller;

use Application\Model\Article;
use Application\Components\View;
use Application\Components\AbstractController;

class ArticleController extends AbstractController
{
    public function indexAction()
    {
        $articles = Article::getAll();
        
        $view = new View([
            'articles' => $articles,
        ]);
        $view->setTemplate('article/index');
        $view->setHeadTitle('Articles');
        $view->ready();
        
        return true;
    }
    
    public function viewAction($id)
    {
        $article = Article::getById((int)$id);
        
        $view = new View([
            'article' => $article,
        ]);
        
        $view->setTemplate('article/view');
        $view->setlayout('indexLayoutSecond');
        $view->setHeadTitle('Article');
        $view->ready();
       
        return true;
    }
}
