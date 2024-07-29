<?php

require_once 'database.php'; 

class Sport {
    // variabelen die nodig zijn voor het aanmaken database en de users 'penningmeester' en 'secretaris'
    public $user;
    public $password;
    private $db;
    // variabelen die nodig zijn voor het aanmaken van een familie 
    public $familyID;
    public $familyName;
    public $address;
    // variabelen die nodig zijn voor het aanmaken van een familielid
    public $id;
    public $name;
    public $familyMember;
    public $birthday;
    // variabelen die nodig is voor het bepalen van de contributie 
    public $membership;
    public $contribution;
    public $year;
    


    public function __construct($user=null, $password=null, $familyID=null, $familyName=null, $address=null, $id=null, $name=null, $familyMember=null, $birthday=null, $membership=null, $year=null) 
    {
        $this->user = $user;
        $this->password = $password;
        $this->familyID = $familyID;
        $this->db = (new Database())->getConnection();
        $this->familyName = $familyName;
        $this->address = $address;
        $this->id = $id;
        $this->name = $name;
        $this->familyMember = $familyMember;
        $this->birthday = $birthday;
        $this->membership = $membership;
        $this->contribution= 100;
        // Als er geen jaar is ingevuld, dan is het het huidige jaar.
        if($year == null){
            $this->year = date("Y");
        }else{
            $this->year= $year;
        }
    }

    // CRUD FUNCTIES CREATE
   

    public function createFamily() {
        $sql = "INSERT INTO familie (naam, adres) VALUES (:naam, :adres)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['naam' => $this->familyName, 'adres' => $this->address]);
            return $stmt;
    }

    public function createFamilyMember() {
        $sql = "INSERT INTO familielid (naam, geboortedatum, familielidRol, familieID) 
                VALUES (:naam, :geboortedatum, :familielidRol, :familieID)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'naam' => $this->name,
            'geboortedatum' => $this->birthday,
            'familielidRol' => $this->familyMember,
            'familieID' => $this->familyID
        ]);


        $memberID = $this->db->lastInsertId(); // Hiermee vraag ik de ID op van de rij die net is toegevoegd, hiermee kan de nieuwe gebruiker opgehaald worden
        $this->createContributie($memberID);
        return $stmt;
    }

    private function createContributie($memberID) {
        // Vraag de leeftijd van de gebruiker op, samen met het familieid
        $sql = "SELECT TIMESTAMPDIFF(YEAR, geboortedatum, STR_TO_DATE(CONCAT(:jaar, '-01-01'), '%Y-%m-%d')) as leeftijd
                from familielid where id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'id' => $memberID,
            'jaar' => $this->year
        ]);

        $userRow = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
        $age = $userRow['leeftijd'];

        // Bereken de hoeveelheid contributie, voor de gebruiker gebasseerd op de leeftijd in het huidige jaar (dit jaar is dus het boekjaar)
        // Deze korting waardes zijn nu hard coded, opgenomen uit de opdracht
        if($age < 8){
            $this->membership = "Jeugd";
            $this->contribution = $this->contribution * 0.5;
        }
        else if($age < 13){
            $this->membership = "Aspirant";
            $this->contribution = $this->contribution * 0.6;
        }
        else if($age < 18){
            $this->membership = "Junior";
            $this->contribution = $this->contribution * 0.75;
        }
        else if($age < 51){
            $this->membership = "Senior";
        }
        else if($age > 50){
            $this->membership = "Oudere";
            $this->contribution = $this->contribution * 0.55;
        }

        // Voeg de contributie rij toe
        $sql = "INSERT INTO contributie (soort_lid, bedrag, boekjaar, familielidID) 
        VALUES (:soort_lid, :bedrag, :boekjaar, :familielidID)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'soort_lid' => $this->membership,
            'bedrag' => $this->contribution,
            'boekjaar' => $this->year,
            'familielidID' => $memberID
        ]);
    }

    // CRUD FUNCTIES READ
    public function showAllFamilies() {
        $sql = $this->db->prepare("SELECT * FROM familie");
        $sql->execute();
        $families = $sql->fetchAll(PDO::FETCH_ASSOC);
    
        return $families;
    }

    public function showFamily() {
        
        $sql = $this->db->prepare("SELECT * FROM familie WHERE familieID = :id");
        $sql->execute(['id' => $this->familyID]);
        $family = $sql->fetch(PDO::FETCH_ASSOC);
        if ($family) {
            $this->familyName = $family['naam'];
            $this->address = $family['adres'];
            $this->familyID = $family['familieID'];
        }

        return $family; 
    }

    public function showFamilyMembers() {
        $sql = $this->db->prepare("SELECT 
        familielid.id, familielid.naam, familielid.geboortedatum, familielid.familielidRol
        FROM familielid
        WHERE familieID = :id");
        $sql->execute(['id' => $this->familyID]);
        $family = $sql->fetchAll(PDO::FETCH_ASSOC);
        
        return $family;
    }

    public function showFamilyMemberContribution() {
        $sql = $this->db->prepare("SELECT 
        familielid.id, familielid.naam, familielid.geboortedatum, contributie.soort_lid, contributie.bedrag, contributie.boekjaar
        FROM familielid
        INNER JOIN contributie ON familielid.id = contributie.familielidID
        WHERE familieID = :id AND contributie.boekjaar = :boekjaar");
        $sql->execute([
            'id' => $this->familyID,
            'boekjaar' => $this->year

        ]);
        $family = $sql->fetchAll(PDO::FETCH_ASSOC);
        
        return $family;
    }

    public function showFamilyMember() {
        $sql = $this->db->prepare("SELECT id, naam, geboortedatum, familielidRol FROM familielid WHERE id = :id");
        $sql->execute(['id' => $this->id]);
        $member = $sql->fetch(PDO::FETCH_ASSOC);
        if ($member) {
            $this->id = $member['id'];
            $this->name = $member['naam'];
            $this->birthday = $member['geboortedatum'];
            $this->familyMember = $member['familielidRol'];
        }
        return $member;
    }

    public function showTotalContribution() {
        $sql = $this->db->prepare("SELECT familie.*, 
            SUM(contributie.bedrag) as totalContributie
            FROM familie
            JOIN familielid ON familielid.familieID = familie.familieID
            JOIN contributie ON contributie.familielidID = familielid.id
            JOIN boekjaar ON contributie.boekjaar = boekjaar.jaar
            WHERE boekjaar.jaar = :jaar
            GROUP BY familie.familieID
        ");
        $sql->execute(['jaar' => $this->year]);
        $families = $sql->fetchAll(PDO::FETCH_ASSOC);
    
        return $families;
    }

    // CRUD FUNCTIES UPDATE
    public function updateFamily() {
        $sql = $this->db->prepare("UPDATE familie SET naam=:naam, adres=:adres  WHERE familieID =:id");
        $sql->execute(['naam' => $this->familyName, 'adres' => $this->address, 'id' => $this->familyID]);

        return $sql->rowCount();
    }

    public function updateFamilyMember() {
        $sql = $this->db->prepare("UPDATE familielid SET naam=:naam, geboortedatum=:geboortedatum, familielidRol = :familielidRol  WHERE id =:id");
        $sql->execute(['naam' => $this->name, 'geboortedatum' => $this->birthday, 'familielidRol' => $this->familyMember, 'id' => $this->id]);

        return $sql->rowCount();
    }

    // CRUD FUNCTIES DELETE
    public function deleteFamily() {
        $sql = $this->db->prepare("DELETE FROM familie WHERE familieID = :id");
        $sql->execute(['id' => $this->familyID]);
    }

    public function deleteFamilyMember() {
        $sql = $this->db->prepare("DELETE FROM familielid WHERE id = :id");
        $sql->execute(['id' => $this->id]);
    }

    // FUNCTIE OM IN TE LOGGEN
    public function login() {
        $sql = "SELECT password FROM user WHERE username = :user";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['user' => $this->user]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user;
    }

    // FUNCTIE OM WACHTWOORD TE VERANDEREN
    // public function changePassword() {
    //     $sql = "UPDATE user SET password = :password  WHERE username = :user";
    //     $stmt = $this->db->prepare($sql);
    //     $stmt->execute(['user' => $this->user, 'password' => $this->password]);
        
    //     return $stmt->rowCount();
    // }

    public function changePassword() {
        // Update query om het gehashte wachtwoord op te slaan
        $sql = "UPDATE user SET password = :password WHERE username = :username";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            // ':password' => ($this->password),
            ':password' => password_hash($this->password, PASSWORD_DEFAULT),
            ':username' => $this->user
        ]);

        return $stmt->rowCount(); 
    }

}
?>