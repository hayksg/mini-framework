<?php

namespace Application\Controller;

use Application\Components\View;
use Application\Components\AbstractController;
use Application\Model\Article;

class AdminarticleController extends AbstractController
{
    public function indexAction()
    {  
        $articles = Article::getAll();
        
        $view = new View([
            'articles' => $articles,
        ]);
        $view->setTemplate('admin-article/index');
        $view->setHeadTitle('Manage articles');
        $view->ready();
        
        return true;
    }
    
    private function uploadFile($files)
    {
        $uploads_dir = ROOT . 'public_html/img/home';

        if (is_dir($uploads_dir)) {              
            if ($files["file"]["error"] === 0) {
                $tmp_name = $files["file"]["tmp_name"];

                // basename() may prevent filesystem traversal attacks;
                $name = $this->clearStr(basename($files["file"]["name"]));

                $uniqueId = uniqid();
                $name = $uniqueId . $name;

                if (move_uploaded_file($tmp_name, "$uploads_dir/$name")) {
                    return '/img/home/' . $name;
                } 
            }
        }
    }
    
    public function addAction()
    {  
        if (isset($_POST['add_article'])) {
            
            $title         = $this->clearStr($_POST['title']);
            $short_content = $this->clearStr($_POST['short_content']);
            $content       = $this->clearStr($_POST['content']);
            $image         = $this->clearStr($this->uploadFile($_FILES));

            $article = new Article();
           
            $article->title         = $title;
            $article->short_content = $short_content;
            $article->content       = $content;
            $article->image         = $image;
            
            $article->save();
            
            $this->redirectTo('/manage-articles');
        }
        
        $view = new View();
        $view->setTemplate('admin-article/add');
        $view->setHeadTitle('Add article');
        $view->ready();
        
        return true;
    }
    
    public function editAction($id)
    {  
        $article = Article::getById($this->clearInt($id));
        
        $view = new View([
            'article' => $article,
        ]);
        $view->setTemplate('admin-article/edit');
        $view->setHeadTitle('Edit article');
        $view->ready();
        
        return true;
    }
    
    public function deleteAction($id)
    {  
        $article = Article::getById($this->clearInt($id));
        
        var_dump($article);
        
        return true;
    }
}
