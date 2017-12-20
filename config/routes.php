<?php

return [
    '' => 'index/index', // indexAction in IndexController
    
    'article/view/([0-9]+)' => 'article/view/$1', // viewAction in ArticleController
    'article/add'           => 'article/add',     // addAction in ArticleController
    'articles'              => 'article/index',   // indexAction in ArticleController
    
    'manage-articles'                 => 'adminarticle/index',     // indexAction in AdminArticleController
    'manage-articles/add'             => 'adminarticle/add',       // addAction in AdminArticleController
    'manage-articles/edit/([0-9]+)'   => 'adminarticle/edit/$1',   // editAction in AdminArticleController
    'manage-articles/delete/([0-9]+)' => 'adminarticle/delete/$1', // deleteAction in AdminArticleController
    'admin'                           => 'admin/index',            // indexAction in AdminController
    
    'news/list/([a-z]+)/([0-9]+)' => 'news/list/$1/$2', // listAction in NewsController
    'news'                        => 'news/index',      // indexAction in NewsController
];
