<?php

namespace Application\Components;

class View extends FunctionsLibrary
{
    private $data;
    const VIEW_PATH = ROOT . 'Application/View/';
    
    public function __construct(array $viewData) 
    {
        $this->data = $viewData;
    }
    
    public function display($template)
    {
        foreach ($this->data as $key => $value) {
            $$key = $value;
        }
        
        //$clear = new FunctionsLibrary;
        
        $file = self::VIEW_PATH . $template . '.phtml';
        if (is_file($file)) {
            include_once($file);
        }
        
        
    }
}
