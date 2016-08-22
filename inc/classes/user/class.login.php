<?php

class Login extends Db {
    
    private $email;
    private $pw;

    private $login;
    private $message;

    public function __construct($email, $pw) {
        if($email && $pw) {
        $db = new Db();
        $db->connect();                
        $this->email = $db->escapeString($email);
        $this->pw = $db->escapeString($pw);
        }
    }

    public function verifyUser() {
        if(!isset($this->email,$this->pw)) {
            $this->login = false;
            $this->message = "Alla fält måste fyllas i.";
        }
    else {
        $db = new Db();
        $db->connect();
        
        $db->sql("SELECT id, email, password FROM users WHERE email = '$this->email'");
        $val = $db->getResult();
        if($db->numRows() == 1) {
        foreach($val as $res) {
            $hash = $res['password'];
            $id = $res['id'];
        }
            $hash = $db->escapeString($hash);
            if(password_verify($this->pw, $hash)) {
                $_SESSION['LOGGEDIN'] = 1;
                $_SESSION['USERID'] = $id;
                $_SESSION['EMAIL'] = $this->email;
            $this->message = "Du har loggats in.";
        }
            else {
                $this->message = "Fel användarnamn eller lösenord";
            }
        }
        else {
            $this->message = "Fel användarnamn eller lösenord.";
        }
    }
    }
    public function getMessages() {
        if(isset($this->message)) {
            return $this->message;
        }
    }
}

?>
