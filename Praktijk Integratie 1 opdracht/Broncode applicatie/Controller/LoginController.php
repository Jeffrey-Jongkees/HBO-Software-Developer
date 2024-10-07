<?php

require_once 'model/user.php';

class LoginController {
    
    // FUNCTIE om in te loggen in de applicatie
    public function login() {
        require_once 'view/login.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //Controleer of de variablen een waarde hebben, en zorg dat deze veilig worden doorgegeven via htmlspecialchars
           $user = isset($_POST['dbUser']) ? htmlspecialchars($_POST['dbUser']) : null;
           $password = isset($_POST['password']) ? htmlspecialchars($_POST['password']) : null;

           //Controleer om er zeker van te zijn dat beide velden ingevuld zijn
           if (!empty($user) && !empty($password)) {
               $dbUser = new User($user, $password);
               $login = $dbUser->login();

               // Vergelijk het opgeslagen wachtwoord in de database met het ingevulde wachtwoord
               if ($login && $password === $login['Wachtwoord']) {
                   $_SESSION['user'] = $user;
                   $_SESSION['loggedin'] = true;
                   header("Location: home-pagina");
                   exit(); // Zorg ervoor dat het script stopt na de redirect
               } else {
                   echo "Gebruikersnaam of wachtwoord is onjuist.";
               }
           } else {
               echo "Beide velden moeten ingevuld worden";
           }
       }
    }

    
    //Functie om uit te loggen en alle session_variabelen te verwijderen
    public function logout() {
        session_unset();
        session_destroy();
        header("Location: landings-pagina");
    }

}

?>