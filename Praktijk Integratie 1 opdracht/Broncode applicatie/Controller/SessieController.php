<?php

class SessieController {
    
    protected function checkLogin() {

        if (!isset($_SESSION['loggedin'])) {
            header("Location: landingpage.php");
            exit();
        }
    }
}
?>