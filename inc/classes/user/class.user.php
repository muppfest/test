<?php

class User extends Db {
   
    static $data;

    private $loggedin;
    private $userid;

    static $message;

    public function __construct($data) {
    
    if(isset($data)) {
        $this->data = $data;
    }

    if(isset($_SESSION['LOGGEDIN'])) {
        $this->loggedin = true;
        $this->userid = $_SESSION['USERID'];
        }
        else {
        $this->loggedin = false;
        $this->message = "Du är inte inloggad.";
        }        
    }
    
    public function showUser() {
        
    if($this->loggedin) {
        $db = new Db();
        $db->connect();
        $db->sql("SELECT * from customers WHERE user_id = '$this->userid'");
        $val = $db->getResult();
        foreach($val as $res) {
            $this->data = $res;
        }
        }
        else{
            $this->loggedin = false;
            $this->message = "Du är inte inloggad.";
        }
    }

    public function editUser() {
        
    if($this->loggedin) {
        $db = new Db();
        $db->connect();
        
        $db->update('customers',$this->data, 'user_id = ' . $this->userid);
        $this->message = $db->getResult();
    }
    else {
        $this->loggedin = false;
        $this->message = "Du är inte inloggad.";
    }
    }
}

?>
