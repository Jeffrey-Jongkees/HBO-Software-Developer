<?php
require_once 'model/sport.php';
require_once 'SessionController.php';


class EditFamilyController  extends SessionController{

    public function __construct() {
        $this->checkLogin(); // Controleer of de gebruiker is ingelogd bij het instantiëren van de controller
    }
    
    public function updateFamily($familyID) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = isset($_POST['familyName']) ? htmlspecialchars($_POST['familyName']) : null;
        $address = isset($_POST['address']) ? htmlspecialchars($_POST['address']) : null;
        
        if (!empty($name) && !empty($address)) {
            $family = new Sport();
            $family->familyID = $familyID; 
            $family->familyName = $name; 
            $family->address = $address; 
            $updateFamily = $family->updateFamily();
            $members = $family->showFamilyMembers();
        } elseif (empty($name) || empty($address)) {
            echo "Beide velden moeten ingevuld zijn";
            $family = new Sport();
            $family->familyID = $familyID;
            $family->familyName = $name; 
            $family->address = $address; 
            $showFamily = $family->showFamily();
            $members = $family->showFamilyMembers();
        }
    } else {
        $family = new Sport();
        $family->familyID = $familyID;
        $family->showFamily();
        $members = $family->showFamilyMembers();
    }require_once 'view/edit-family.php';
}

public function updateFamilyMember($id, $familyID) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
         //Controleer of de variablen een waarde hebben, en zorg dat deze veilig worden doorgegeven via htmlspecialchars
        $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : null;
        $birthday = isset($_POST['birthday']) ? htmlspecialchars($_POST['birthday']) : null;
        $familyMember = isset($_POST['familyMember']) ? htmlspecialchars($_POST['familyMember']) : null;
        
        if (!empty($name) && !empty($birthday) && !empty($familyMember)) {
            $member = new Sport();
            $member->id = $id;
            $member->name = $name;
            $member->birthday = $birthday; 
            $member->familyMember = $familyMember;
            $updateMember = $member->updateFamilyMember();
            header('Location: edit-family?familyID=' . $familyID);
            exit();
        } 
        elseif(empty($name) || empty($birthday) || empty($familyMember)){
            echo "Alle velden moeten ingevuld zijn";
            $member = new Sport();
            $member->id = $id;
            $member->name = $name;
            $member->birthday = $birthday; 
            $member->familyMember = $familyMember;
            $showMember = $member->showFamilyMember();
        }
        } else {
            $member = new Sport();
            $member->id = $id;
            $member->familyID = $familyID;
            // echo "familieID: " .$member->familyID;
            $showMember = $member->showFamilyMember();
            }
        require_once 'view/edit-family-member.php';
    }

    public function deleteFamilyMember($id, $familyID) {
        $family = new Sport();
        $family->id = $id;
        $family->familyID = $familyID;
        $family->deleteFamilyMember();;
        require_once 'view/delete-family-member.php';
        header('Location: edit-family?familyID=' . $familyID);
        exit();
    }
}
?>