<?php

namespace Application\Controller;

use Application\Components\View;
use Application\Components\AbstractController;

class AdminarticleController extends AbstractController
{
    public function indexAction()
    {   
        
        $view = new View();
        $view->setTemplate('admin-article/index');
        $view->setHeadTitle('Manage articles');
        $view->ready();
        
        return true;
    }
}
