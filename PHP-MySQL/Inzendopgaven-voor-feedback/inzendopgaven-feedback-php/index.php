<?php

// Laad de vereiste bestanden in
require_once 'models/Article.php';
require_once 'controllers/HomeController.php';
require_once 'controllers/ArticleController.php';

include 'layout/header.php';	

// Ontvang de request en verwerk de route naar de juiste controller
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$urlSegments = explode('home', trim($url, '/'));
$action = !empty($urlSegments[1]) ? $urlSegments[1] : 'home';



// Controleer welke controller en methode moet worden uitgevoerd
switch ($action) {
    case 'home':
        $controller = new HomeController();
        $controller->index();
        break;
    case 'article':
        $controller = new ArticleController();
        $controller->index();
        break;
    case 'edit':
        $controller = new ArticleController();
        $controller->edit();
        break;
    case 'delete':
        $controller = new ArticleController();
        $controller->delete();
        break;
    default:
        header('HTTP/1.0 404 Not Found');
        echo 'Pagina niet gevonden';
        break;
}
?>