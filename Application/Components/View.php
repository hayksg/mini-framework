<?php

namespace Application\Components;

class View extends AbstractView
{
    const VIEW_PATH = ROOT . 'Application/View/';
    const LAYOUT_PATH = ROOT . 'Application/View/layout/';
    
    private $data = [];
    private $template = '';
    private $layout = 'indexLayout';
    private $headTitle = '';
    
    public function __construct(array $viewData = []) 
    {
        $this->data = $viewData;
    }
    
    public function setTemplate($template)
    {
        $this->template = $template;
    }
    
    public function getTemplate()
    {
        return $this->template;
    }
    
    public function template()
    {
        foreach ($this->data as $key => $value) {
            $$key = $value;
        }
        
        $file = self::VIEW_PATH . $this->getTemplate() . '.phtml';
        if (is_file($file)) {
            include_once($file);
        }
    }
    
    public function layout()
    { 
        $file = self::LAYOUT_PATH . $this->getlayout() . '.phtml';
        
        if (is_file($file)) {
            include_once($file);
        }
    }
    
    public function setlayout($layout)
    {
        $this->layout = $layout;
    }
    
    public function getlayout()
    {
        return $this->layout;
    }
    
    public function setHeadTitle($headTitle)
    {
        $this->headTitle = $headTitle;
    }
    
    public function getHeadTitle()
    {
        return $this->headTitle;
    }
    
    public function ready()
    {
        $this->layout();
    }
}
