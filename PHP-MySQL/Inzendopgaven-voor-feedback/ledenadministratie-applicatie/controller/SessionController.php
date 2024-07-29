<?php

class SessionController {
    
    protected function checkLogin() {
        if (!isset($_SESSION['loggedin'])) {
            header("Location: landingpage.php");
            exit();
        }
    }
}
?>
