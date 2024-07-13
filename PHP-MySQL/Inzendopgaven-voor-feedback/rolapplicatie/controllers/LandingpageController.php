<?php

require_once 'model/user.php';

class LandingPageController {
    public function index() {
        $user = new User(null, null. null, null);
        $user->createTable();
        require_once 'view/landingpage.php';
    }
}
?>