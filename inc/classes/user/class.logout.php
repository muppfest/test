<?php

class Logout {
    
    private $message;

    public function logoutUser() {
        unset($_SESSION['LOGGEDIN']);
        unset($_SESSION['USERID']);
        unset($_SESSION['EMAIL']);
        session_destroy();

        $this->message = "Du är nu utloggad.";
    }

}

?>
