<?php

require_once 'model/user.php';

class DashboardController {
    public function dashboard() {
        $users = new User(null, null);
        $allUsers = $users->showAllUsers();
        require_once 'view/dashboard.php';
    }
}
?>