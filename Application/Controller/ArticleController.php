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
        //$view->setlayout('indexLayoutSecond');
        $view->setHeadTitle('Article');
        $view->ready();
       
        return true;
    }
    
    public function addAction()
    {
        if (isset($_POST['add_article'])) {
            
            $title        = $this->clearStr($_POST['title'], 1);
            $shortContent = $this->clearStr($_POST['short_content'], 1);
            $content      = $this->clearStr($_POST['content'], 1); 
            
            $article = new Article;
            $article->title        = $title;
            $article->shortContent = $shortContent;
            $article->content      = $content;
            
            
        }
        
        
        
        $view = new View();
        
        $view->setTemplate('article/add');
        $view->setHeadTitle('Add article');
        $view->ready();
       
        return true;
    }
}
