<?php

return [
    '' => 'index/index', // indexAction in IndexController
    
    'article/view/([0-9]+)' => 'article/view/$1', // viewAction in ArticleController
    'articles'    => 'article/index', // indexAction in ArticleController
    
    'news/list/([a-z]+)/([0-9]+)' => 'news/list/$1/$2',  // listAction in NewsController
    'news' => 'news/index', // indexAction in NewsController
];
