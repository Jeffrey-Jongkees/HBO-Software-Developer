<?php

require_once 'model/user.php';


class HomePageController {
    
    public function home() {
        require_once 'view/home.php';
        $user = new User(null, null);
        
    }

    public function adminCreatesUser() {
        require_once 'view/home.php';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $role = $_POST['role'];

            if (!empty($username) && !empty($password) && !empty($role)) {
                $user = new User($username, $password, $role, null);

                if ($user->verifyIfUsernameIsUnique()) {
                    $user->adminCreatesUser();
                    echo "Gebruiker is aangemaakt";
                } else {
                    echo "Gebruikersnaam is al in gebruik";
                }
            }else {
                echo "Alle velden moeten ingevuld worden";
            }
        }
    }

    public function updateUser() {
        require_once 'view/home.php';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['newpassword'];

            if (!empty($username) && !empty($password)) {
                $user = new User($username, $password, null, null);
                $user->updateUser();
                echo "Password is aangepast";
            }else {
                echo "Beide velden moeten ingevuld worden";
            }
        }
    }
}
?>