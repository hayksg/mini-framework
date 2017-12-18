<?php

namespace Application\Controller;

use Application\Model\Article;
use Application\Components\View;

class ArticleController 
{
    public function indexAction()
    {
        $articles = Article::getAll();
        
        $view = new View([
            'articles' => $articles,
        ]);
        $view->display('article/index');
        
        return true;
    }
    
    public function viewAction($id)
    {
        $article = Article::getById((int)$id);
        
        $view = new View([
            'article' => $article,
        ]);
        $view->display('article/view');
        
        return true;
    }
}
