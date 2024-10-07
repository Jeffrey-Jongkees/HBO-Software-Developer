<?php 

require_once 'database.php'; 

class User {
    // variabelen die nodig zijn voor het aanmaken database en de gebruikers 'admin' en 'klant'
    public $user;
    public $password;
    private $db;
    
    public function __construct($user=null, $password=null) 
    {
        $this->user = $user;
        $this->password = $password;
        $this->db = (new Database())->getConnection();
    }

    // FUNCTIE OM IN TE LOGGEN
    public function login() {
        $sql = "SELECT Wachtwoord FROM gebruiker WHERE Gebruikersnaam = :user";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['user' => $this->user]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user;
    }
}



?>