<?php
require_once 'controllers/LoginController.php';   
require_once 'controllers/LandingpageController.php';
require_once 'controllers/HomePageController.php';
require_once 'controllers/DashboardController.php';
require_once 'controllers/UserController.php';

// Ontvang de request en verwerk de route naar de juiste controller
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$urlSegments = explode('/', trim($url, '/'));
$action = !empty($urlSegments[1]) ? $urlSegments[1] : 'landingpage';

// Controleer welke controller en methode moet worden uitgevoerd
switch ($action) {
    case 'landingpage':
        $controller = new LandingPageController();
        $controller->index();
        break;
    case 'login':
        $controller = new LoginController();
        $controller->login();
        break;
    case 'logout':
        $controller = new LoginController();
        $controller->logout();
        break;
    case 'home':
        $controller = new HomePageController();
        $controller->home();
        break;
    case 'dashboard':
        $controller = new DashboardController();
        $controller->dashboard();
        break;
    case 'create':
        $controller = new UserController();
        $controller->create();
        break;
    case 'adminCreate':
        $controller = new HomepageController();
        $controller->adminCreatesUser();
        break;
    case 'update':
        $controller = new HomepageController();
        $controller->updateUser();
        break;
    default:
        header('HTTP/1.0 404 Not Found');
        echo 'Pagina niet gevonden';
        break;
}

?>