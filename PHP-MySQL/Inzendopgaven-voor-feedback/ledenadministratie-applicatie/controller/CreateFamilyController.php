<?php

require_once 'model/sport.php';
require_once 'SessionController.php';

class CreateFamilyController extends SessionController {

    public function __construct() {
        $this->checkLogin(); // Controleer of de gebruiker is ingelogd bij het instantiëren van de controller
    }

    //CRUD FUNCTIES CREATE OM EEN NIEUWE FAMILIE AAN TE MAKEN
    public function createFamilyMember($familyID) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //Controleer of de variablen een waarde hebben, en zorg dat deze veilig worden doorgegeven via htmlspecialchars
            $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : null;
            $birthday = isset($_POST['birthday']) ? htmlspecialchars($_POST['birthday']) : null;
            $member = isset($_POST['familyMember']) ? htmlspecialchars($_POST['familyMember']) : null;

            if (!empty($name) && !empty($birthday) && !empty($member)) {
                $family = new Sport();
                $family->familyID = $familyID;
                $family->name = $name;
                $family->birthday = $birthday; 
                $family->familyMember = $member;
                // $family->year = 2023;
                $createMember = $family->createFamilyMember();
                $showFamily = $family->showFamily();
                $members = $family->showFamilyMembers();            
            } 
            else {
                echo "Alle velden moeten ingevuld zijn";
                $family = new Sport();
                $family->familyID = $familyID;
                $family->showFamily();
                $members = $family->showFamilyMembers();
            }
        } require_once 'view/edit-family.php';
    }

    public function submitFamily() {
        require_once 'view/create-family.php';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $familyName = isset($_POST['familyName']) ? htmlspecialchars($_POST['familyName']) : null;
            $address = $_POST['address'] ? htmlspecialchars($_POST['address']) : null;
    
            if (!empty($familyName) && !empty($address)) {
                $family = new Sport();
                $family->familyName = $familyName;
                $family->address = $address;
                $createFamily = $family->createFamily();
                header('Location: home');
                exit();
            } else {
                echo "Er is geen naam of adres ingevoerd, deze velden zijn verplicht";
            }
        } else {
            echo "Familie niet toegevoegd, er is iets mis gegaan met de post request";
        } 
    }
}
?>