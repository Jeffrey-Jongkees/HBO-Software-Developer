<?php

require_once 'model/sport.php';
require_once 'SessionController.php';

class HomePageController extends SessionController {

    public function __construct() {
        $this->checkLogin(); // Controleer of de gebruiker is ingelogd bij het instantiëren van de controller
    }
    
    //CRUD FUNCTIE CREATE MAAK EEN NIEUWE FAMILIE AAN
    public function createFamily() {
        require_once 'view/create-family.php';
    }

    //CRUD FUNCTIES READ GEEF ALLE FAMILIELEDEN WEER
    public function contribution($familyID, $year) {
        $family = new Sport();
        $family->familyID = $familyID;
        $family->year = $year;
        // echo"FamilieID: " . $family->familyID;
        // echo"<br>Year: " . $year . "<br>";
        // echo"familyYear: " .  $family->year . "<br>";
        $members = $family->showFamilyMemberContribution();
        require_once 'view/contribution.php';
    }
    
    // GEEF HET TOTAAL AAN CONTRIBUTIE PER FAMILIE WEER
    public function year($year) {
        $family = new Sport();
        $family->year = $year;
        $families = $family->showTotalContribution();
        require_once 'view/financial-year.php';
    }


    // GEEF ALL FAMILIE'S WEER
    public function home() {
        $family = new Sport();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = isset($_POST['username']) ? htmlspecialchars($_POST['username']) : null;
            $password = isset($_POST['newpassword']) ? htmlspecialchars($_POST['newpassword']) : null;
            
            if (!empty($user) && !empty($password)){
                $family->user = $user;
                $family->password = $password;
                $change = $family->changePassword();
                if ($change) {
                    echo "Wachtwoord succesvol gewijzigd.";
                } else {
                    echo "Er is iets misgegaan bij het wijzigen van het wachtwoord.";
                }
            } else {
                echo "Er moet eerst een nieuw wachtwoord ingevoerd worden";
            }
        }
        
        // Haal altijd de families op, ongeacht of er een POST request was of niet
        $families = $family->showAllFamilies();
        require_once 'view/home.php';
}

    //CRUD FUNCTIES DELETE VERWIJDER EEN FAMILIE
    public function deleteFamily($familyID) {
        $family = new Sport(null, null, $familyID);
        $family->deleteFamily();
        require_once 'view/delete-family.php';
        header('Location: home');
        exit();
    }
}?>