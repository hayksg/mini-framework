<?php

namespace Application\Controller;

use Application\Components\View;
use Application\Components\AbstractController;

class IndexController extends AbstractController
{
    public function indexAction()
    {
        $view = new View();
        $view->setTemplate('index/index');
        $view->setHeadTitle('Home');
        $view->ready();
        
        return true;
    }
}
