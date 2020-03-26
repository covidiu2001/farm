<?php

return [
    'notLoggedIn' => [
        'Home' => [
            'text' => 'lang.menu.home',
            'a_class' => 'nav-link',
            'href' => '/',
            'li_class' => 'nav-item',
        ],
        /* Menu with items */
        'Categories' => [
            'text' => 'lang.menu.categories',
            'a_class' => 'nav-link dropdown-toggle arrow',
            'href' => '',
            'li_class' => 'dropdown',
//            'items' => [
//                'Cat1' => [
//                    'text' => 'Categoria 1',
//                    'a_class' => '',
//                    'href' => '/',
//                ],
//                'Cat2' => [
//                    'text' => 'Categoria 2',
//                    'a_class' => '',
//                    'href' => '/',
//                ],
//                'Cat3' => [
//                    'text' => 'Categoria 3',
//                    'a_class' => '',
//                    'href' => '/',
//                ],
//                'Cat4' => [
//                    'text' => 'Categoria 4',
//                    'a_class' => '',
//                    'href' => '/',
//                ],
//            ]
        ],
//        'Products' => [
//            'text' => 'lang.menu.products',
//            'a_class' => 'nav-link',
//            'href' => '/displayProducts',
//            'li_class' => 'nav-item',
//        ],    
        'Galery' => [
            'text' => 'lang.menu.galery',
            'a_class' => 'nav-link',
            'href' => '/galery',
            'li_class' => 'nav-item',
        ],
//        'Shop' => [
//            'text' => 'lang.menu.shop',
//            'a_class' => 'nav-link',
//            'href' => '/shop',
//            'li_class' => 'nav-item',
//        ],
        'Account' => [
            'text' => 'lang.menu.account',
            'a_class' => 'nav-link',
            'href' => '/account',
            'li_class' => 'nav-item',        
        ],        
        'Contact' => [
            'text' => 'lang.menu.contact',
            'a_class' => 'nav-link',
            'href' => '/contact',
            'li_class' => 'nav-item',
        ]
    ],
    'admin' => [
        'Admin' => [
            'text' => 'Admin',
            'a_class' => 'nav-link',
            'href' => '/admin',
            'li_class' => 'nav-item',
        ],
    ],
];