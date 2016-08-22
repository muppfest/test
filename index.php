<?php
require('inc/path.php');
require('inc/config.php');

switch ((isset($_GET['page']) ? $_GET['page'] : '')) {
    
    case 'ad':
        include('tpl/ad.tpl.php');
    break;

    case 'ads':
        include('tpl/ads.tpl.php');
    break;

    case 'kat':
        include('tpl/categories.tpl.php');
    break;

    case 'search':
        require('inc/search.php');
        include('tpl/search.tpl.php');
    break;

    case 'add':
        require('inc/add.php');
        include('tpl/add.tpl.php');
    break;

    case 'lan':
        include('tpl/lan.tpl.php');
    break;

    default: 
        if(empty($_GET['page'])) {
            include('tpl/home.tpl.php');
        }
        else {
            header('HTTP/1.0 404 NOT FOUND');
            include('page_not_found.php');
        }
    break;
}
?>
