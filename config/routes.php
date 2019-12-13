<?php

return array(
    '_root_' => 'page/index', // The default route
    '_404_' => 'base/public/404', // The main 404 route
    'test3874klpei38' => 'base/public/test3874klpei38', // sitemap.xml
    'testoauth2_connect' => 'base/public/testoauth2_connect', // sitemap.xml
    'testoauth2_complete' => 'base/public/testoauth2_complete', // sitemap.xml
    'sitemap.xml' => 'base/public/sitemap', // sitemap.xml
    'admin/newscategory/list' => 'application/admin_application/list',
    'admin/newscategory/create' => 'application/admin_application/create',
    'admin/newscategory/update/(:segment)' => 'application/admin_application/update/$1',
    'admin/newscategory/update_seo/(:segment)' => 'application/admin_application/update_seo/$1',
    'admin/newscategory/delete/(:segment)' => 'application/admin_application/delete/$1',
    'admin/newslist' => 'application/admin_casestudy/list',
    'admin/newslist/create' => 'application/admin_casestudy/create',
    'admin/newslist/update/(:segment)' => 'application/admin_casestudy/update/$1',
    'admin/newslist/update_seo/(:segment)' => 'application/admin_casestudy/update_seo/$1',
    'admin/newslist/delete/(:segment)' => 'application/admin_casestudy/delete/$1',
    'search' => 'product/_search',
    'filter' => 'category/_filter',
    'forgot-password' => 'user/password',

    'deals' => 'product/deals',
    'deals/(:segment)/(:segment)' => 'product/deals/$1/$2',

    'admin' => 'admin/index',
    'api' => 'api/index',

    'categories' => 'product/categories', // Main Product Categories
    'product/categories' => 'base/public/404', // Main Product Categories

    'page/index/(:any)' => 'base/public/404', // disable routes
    'product/category/index/(:segment)' => 'base/public/404', // disable routes
    'product/index/(:segment)' => 'base/public/404', // disable routes
    '500' => 'base/public/500', // disable routes

    '(:segment)' => 'base/public/is_exist/$1', // Check if segment is existing page, product category or product

);