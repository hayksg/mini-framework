<?php

class NewsController 
{
    public function indexAction()
    {
        echo __METHOD__;
        
        return true;
    }
    
    public function listAction($category, $id)
    {
        echo $category;
        echo '<br>';
        echo $id;
        
        return true;
    }
}
