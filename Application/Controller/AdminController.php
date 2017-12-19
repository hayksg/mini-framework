<?php

namespace Application\Controller;

use Application\Components\View;
use Application\Components\AbstractController;

class AdminController extends AbstractController
{
    public function indexAction()
    {   
        
        $view = new View();
        $view->setTemplate('admin/index');
        $view->setHeadTitle('Admin area');
        $view->ready();
        
        return true;
    }
}
