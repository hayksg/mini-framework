<?php

namespace Application\Controller;

use Application\Components\View;
use Application\Components\AbstractController;
use Application\Model\Article;

class AdminarticleController extends AbstractController
{
    const IMAGE_DIR = ROOT . 'public_html/img/article';
    
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
        if (is_dir(self::IMAGE_DIR)) {              
            if ($files["file"]["error"] === 0) {
                $tmp_name = $files["file"]["tmp_name"];

                // basename() may prevent filesystem traversal attacks;
                $name = $this->clearStr(basename($files["file"]["name"]));

                $uniqueId = uniqid();
                $name = $uniqueId . $name;

                if (move_uploaded_file($tmp_name, self::IMAGE_DIR . '/' . $name)) {
                    return '/img/article/' . $name;
                } 
            }
            
            return false;
        }
    }
    
    public function addAction()
    {  
        if (isset($_POST['add_article'])) {
            
            $title         = $this->clearStr($_POST['title']);
            $short_content = $this->clearStr($_POST['short_content']);
            $content       = $this->clearStr($_POST['content']);
            $image         = $this->clearStr($this->uploadFile($_FILES));
            
            if (! $image) {
                $image = '/img/home/no-image.jpg';
            }

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
        
        if (isset($_POST['edit_article'])) {
            
            $title         = $this->clearStr($_POST['title']);
            $short_content = $this->clearStr($_POST['short_content']);
            $content       = $this->clearStr($_POST['content']);
            $image         = $this->clearStr($this->uploadFile($_FILES));
            
            if ((! empty($image)) && ($image !== $article->image)) {
                $this->deleteImage($article);
            } else {
                $image = $article->image;
            }
            
            $article->title         = $title;
            $article->short_content = $short_content;
            $article->content       = $content;
            $article->image         = $image;
            
            $article->save();
            
            $this->redirectTo('/manage-articles');
        }
        
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
        
        if ($article) {
            $this->deleteImage($article);

            if ($article->delete((int)$id)) {
                $this->redirectTo('/manage-articles');
            }
        }
    }
    
    private function deleteImage($article)
    {
        $image = self::IMAGE_DIR . '/' . basename($article->image);
        
        if (is_file($image)) {
            unlink($image);
            return true;
        }
        
        return false;
    }
}
