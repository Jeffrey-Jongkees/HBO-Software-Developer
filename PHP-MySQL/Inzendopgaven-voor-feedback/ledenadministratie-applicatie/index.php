<?php
require_once 'controller/SessionController.php';
require_once 'controller/LandingpageController.php';
require_once 'controller/LoginController.php';
require_once 'controller/HomepageController.php';
require_once 'controller/EditFamilyController.php';
require_once 'controller/CreateFamilyController.php';

// Start de sessie
session_start();

// Ontvang de request en verwerk de route naar de juiste controller
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$urlSegments = explode('/', trim($url, '/'));
$action = !empty($urlSegments[1]) ? $urlSegments[1] : 'landingpage';

$id = isset($_GET['id']) ? $_GET['id'] : null;
$familyID = isset($_GET['familyID']) ? $_GET['familyID'] : null;
$year = isset($_GET['year']) ? $_GET['year'] : null;

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
    case 'home':
        $controller = new HomePageController();
        $controller->home();
        break;
    // case 'password':
    //     $controller = new HomePageController();
    //     $controller->changePassword();
    //     break;
    case 'financial-year':
        $controller = new HomepageController();
        $controller->year($year);
        break;
    case 'logout':
        $controller = new LoginController();
        $controller->logout();
        break;
    case 'contribution':
        $controller = new HomePageController();
        $controller->contribution($familyID, $year);
        break;
    case 'delete-family':
        $controller = new HomePageController();
        $controller->deleteFamily($familyID);
        break;
    case 'delete-family-member':
        $controller = new EditFamilyController();
        $controller->deleteFamilyMember($id, $familyID);
        break;
    case 'edit-family':
        $controller = new EditFamilyController();
        $controller->updateFamily($familyID);
        break;
    case 'edit-family-member':
        $controller = new EditFamilyController();
        $controller->updateFamilyMember($id, $familyID);
        break;
    case 'create-family-member':
        $controller = new CreateFamilyController();
        $controller->createFamilyMember($familyID);
        break;
    case 'create-family':
        $controller = new HomePageController();
        $controller->createFamily();
        break;
    case 'submit':
        $controller = new CreateFamilyController();
        $controller->submitFamily();
        break;
    default:
        header('HTTP/1.0 404 Not Found');
        echo 'Pagina niet gevonden';
        break;
}

?>