<?php

require_once 'Database.php'; 

class User {
    public $id;
    public $username;
    public $password;
    public $role;
    private $db;

    public function __construct($username, $password, $role=null, $id=null) {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->role = $role;
        $this->db = (new Database())->getConnection();
    }

    public function createTable() {      
        
        $sql = $this->db->prepare("CREATE TABLE IF NOT EXISTS users(
        id INT(6) NOT NULL AUTO_INCREMENT,
        username VARCHAR(50) UNIQUE NOT NULL,
        password VARCHAR(255) NOT NULL,
        role VARCHAR(50) NOT NULL,
        PRIMARY KEY(id)
        );");
        $sql->execute();


    } 

    public function createUser() {
        
        $sql = "INSERT INTO users (id, username, password, role) 
        VALUES (:id, :username, :password, 'user')";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $this->id, 'username' => $this->username, 'password' => $this->password]);

        return $stmt;
    }

    public function adminCreatesUser() {
        
        $sql = "INSERT INTO users (id, username, password, role) 
        VALUES (:id, :username, :password, :role)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $this->id, 'username' => $this->username, 'password' => $this->password, 'role' => $this->role]);

        return $stmt;
    }

    public function updateUser() {
        $sql = $this->db->prepare("UPDATE users SET password=:password  WHERE username =:username");
        $sql->execute(['username' => $this->username, 'password' => $this->password]);

        return $sql->rowCount();
    }



    public function verifyIfUsernameIsUnique() {

        $sql = "SELECT username FROM users WHERE username = :username";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['username' => $this->username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user === false;

    }

    public function login() {
        $sql = "SELECT * FROM users WHERE username = :username";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['username' => $this->username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user;

    }


    public function showAllUsers() {
        $sql = $this->db->prepare("SELECT * FROM users");
        $sql->execute();
        $users = $sql->fetchAll(PDO::FETCH_ASSOC);

        return $users;
        print_r($users);
    }

}
?>
