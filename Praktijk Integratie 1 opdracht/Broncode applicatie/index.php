<?php
require_once 'Controller/LandingsPaginaController.php';
require_once 'Controller/LoginController.php';
require_once 'Controller/HomePaginaController.php';
require_once 'Controller/BetaalPaginaController.php';
require_once 'Controller/VakkenVullenController.php';
require_once 'Controller/OverzichtController.php';

// Start de sessie
session_start();

// Ontvang de request en verwerk de route naar de juiste controller
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$urlSegments = explode('/', trim($url, '/'));
$action = !empty($urlSegments[1]) ? $urlSegments[1] : 'landings-pagina';

$id = isset($_GET['id']) ? $_GET['id'] : null;


// Controleer welke controller en methode moet worden uitgevoerd
switch ($action) {
    case 'landings-pagina':
        $controller = new LandingsPaginaController();
        $controller->index();
        break;
    case 'login':
        $controller = new LoginController();
        $controller->login();
        break;
    case 'home-pagina':
        $controller = new HomePaginaController();
        $controller->home();
        break;
    case 'selecteer-product':
        $controller = new HomePaginaController();
        $controller->selecteerProduct();
        break;
    case 'betaal-pagina':
        $controller = new BetalingsController();
        $controller->index();
        break;
    case 'betaling-contant':
        $controller = new BetalingsController();
        $controller->contant();
        break;
    case 'betaling-pin':
        $controller = new BetalingsController();
        $controller->pin($id);
        break;
    case 'lege-vakken-vullen':
        $controller = new VakkenVullenController();
        $controller->vullen();
        break;
    case 'logout':
    $controller = new LoginController();
    $controller->logout();
    break;
    case 'overzicht':
        $controller = new OverzichtController();
        $controller->overzicht();
        break;
    default:
        header('HTTP/1.0 404 Not Found');
        echo 'Pagina niet gevonden';
        break;
}

?>