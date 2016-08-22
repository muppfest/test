<?php

class Register extends Db {

    private $email;
    private $pw;
    private $pw2;

    private $emailVerified;
    private $pwVerified;
    private $dataVerified;
    private $message;

    private $checkemail = "/^[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}$/i";

    
    public function __construct($email,$pw, $pw2) {    
        
        if($email && $pw && $pw2 ) {
        $db = new Db();
        $db->connect();
                
        $this->email = $db->escapeString($email);
        $this->pw = $db->escapeString($pw);
        $this->pw2 = $db->escapeString($pw2);
        }
    }

    public function verifyPw() {
    
    if($this->pw != $this->pw2){
        $this->pwVerified = false;
        $this->message = "Lösenorden stämmer inte överens.";
        }
        else {  
        if(strlen($this->pw) < 5) {
            $this->pwVerified = false;
            $this->message = "Lösenordet måste vara längre än 5 tecken.";            
        }
        else {
            $this->pwVerified = true;
        }
        }
    }

    public function verifyEmail() {
        $db = new Db();
        $db->connect();
        $db->sql("SELECT email FROM users WHERE email = '$this->email'");
        
        if($db->numRows() > 0) {
            $this->message = "E-mail redan registrerad.";
            $this->emailVerified = false;
        }
        else {      
            if(!preg_match($this->checkemail, $this->email)) {
                $this->message = "Felaktig e-mail.";
                $this->emailVerified = false;
            }
            else {
            $this->emailVerified = true;
            }
        }
    }

    public function verifyData() {
        if(!isset($this->email,$this->pw,$this->pw2)) {
            $this->dataVerified = false;
            $this->message = "Alla fält måste fyllas i.";
        }
        else {
                $this->verifyEmail();
                $this->verifyPw();
            if($this->emailVerified && $this->pwVerified == true){
                $this->dataVerified = true;
        }
    }
    }

    public function createUser() {
        if($this->dataVerified == true) {
            $db = new Db();
            $db->connect();
            $pw = password_hash($this->pw, PASSWORD_BCRYPT);
            $hash = $db->escapeString($pw);
            $db->insert('users',array('email'=>$this->email,'password'=>$hash));
         }
        else {
            
        }
    }
    public function getMessages() {
        if(isset($this->message)) {
            return $this->message;
        }
    }
}

?>
