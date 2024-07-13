<?php

require_once 'model/user.php';

session_start();

class LoginController {

    public function login() {
        require_once 'view/login.php';
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            if (!empty($username) && !empty($password)) {
                $user = new User($username, $password);
                
                $dbUser = $user->login();
                if ($dbUser && $dbUser['password'] === $password) {
                    $_SESSION['username'] = $dbUser['username'];
                    $_SESSION['role'] = $dbUser['role'];
                    header("Location: home");
                } else {
                    echo "Gebruikersnaam of wachtwoord is onjuist.";
                }
            } else {
                echo "Beide velden moeten ingevuld worden";
            }
        }
    }
    
    public function logout() {
        session_unset();
        session_destroy();
        header("Location: landingpage");
    }
}
?> 