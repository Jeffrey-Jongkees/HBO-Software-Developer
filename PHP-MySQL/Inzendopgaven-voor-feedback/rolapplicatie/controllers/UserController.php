<?php
require_once 'model/user.php';

class UserController {

    public function create() {
        require_once 'view/create.php';
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['createusername'];
            $password = $_POST['createpassword'];

            if (!empty($username) && !empty($password)) {
                $user = new User($username, $password, null, null);

                if ($user->verifyIfUsernameIsUnique()) {
                    $user->createUser();
                    header('Location: login');
                } else {
                    echo "Gebruikersnaam is al in gebruik";
                }
            }else {
                echo "Beide velden moeten ingevuld worden";
            }
        }
    }
}
