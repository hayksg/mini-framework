<?php

return [
    'article/([0-9]+)' => 'article/view', // viewAction in ArticleController
    'article'    => 'article/index', // indexAction in ArticleController
    
    'news/list/([a-z]+)/([0-9]+)' => 'news/list/$1/$2',  // listAction in NewsController
    'news' => 'news/index', // indexAction in NewsController
];
