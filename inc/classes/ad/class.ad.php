<?php

class Ad extends Db {
    

    static $return_data;
    static $message;
    static $ad_count;

    private $data;

    public function __construct($data) {
        
        if(isset($data)) {
        $this->data = $data;
        }
    }

    public function getCat() {
        $db = new Db();
        $db->connect();
        $data = $db->escapeString($this->data);
        $db->sql("SELECT * FROM Categories WHERE Cat_Id = '$data'");
        $res = $db->getResult();

        foreach($res as $val) {
            $this->return_data = $val;
        }
    }

    public function showAdCat() {
        $db = new Db();
        $db->connect();
        $data = $db->escapeString($this->data);
        $db->sql("SELECT * FROM Ads WHERE Cat_Id = '$data' AND Activated > 0");
        $this->return_data = $db->getResult();
        $this->ad_count = $db->numRows();     
    }

    public function showCats() {
        $db = new Db();
        $db->connect();
        $db->sql("SELECT * FROM Categories");
        $this->return_data = $db->getResult();
    }

     public function showAds() {
        $db = new Db();
        $db->connect();
        $db->sql("SELECT * FROM Ads WHERE Activated > 0");
        $this->return_data = $db->getResult();
        $this->ad_count = $db->numRows();
    }

    public function getAd() {
        $db = new Db();
        $db->connect();
        $data = $db->escapeString($this->data);
        $db->sql("SELECT * FROM Ads WHERE Ad_Id = '$data' AND Activated > 0");
        $res = $db->getResult();
        $this->ad_count = $db->numRows();

        foreach($res as $val) {
            $this->return_data = $val;
        }
    }

    public function showStates() {
        $db = new Db();
        $db->connect();
        $db->sql("SELECT * FROM States");
        $this->return_data = $db->getResult();
    }

    public function showAdState() {
        $db = new Db();
        $db->connect();
        $data = $this->data;
        $data = $db->escapeString($data);
        $db->sql("SELECT * FROM Ads WHERE State_Id = '$data' AND Activated > 0");
        $this->return_data = $db->getResult();
        $this->ad_count = $db->numRows();
    }

    public function getState() {
        $db = new Db();
        $db->connect();
        $data = $db->escapeString($this->data);
        $db->sql("SELECT * FROM States WHERE State_Id = '$data'");
        $res = $db->getResult();

        foreach($res as $val) {
            $this->return_data = $val;
        }
    }
    
    public function showTypes() {
        $db = new Db();
        $db->connect();
        $db->sql("SELECT * FROM Type");
        $this->return_data = $db->getResult();
    }

    public function showAdType() {
        $db = new Db();
        $db->connect();
        $data = $db->escapeString($this->data);
        $db->sql("SELECT * FROM Ads WHERE Type_Id = '$data'");
        $this->return_data = $db->getResult();
        $this->ad_count = $db->numRows();
    }

    public function getType() {
        $db = new Db();
        $db->connect();
        $data = $db->escapeString($this->data);
        $db->sql("SELECT * FROM Type WHERE Type_Id = '$data'");
        $res = $db->getResult();

        foreach($res as $val) {
            $this->return_data = $val;
        }
    }

    public function getMuni() {
        $db = new Db();
        $db->connect();
        $data = $db->escapeString($this->data);
        $db->sql("SELECT * FROM Municipalities WHERE State_Id = '$data'");
        $this->return_data = $db->getResult();
    }
    
    public function showMunis() {
        $db = new Db();
        $db->connect();
        $db->sql("SELECT * FROM Municipalities");
        $this->return_data = $db->getResult();        
    }

    public function showMuni() {
        $db = new Db();
        $db->connect();
        $data = $db->escapeString($this->data);
        $db->sql("SELECT * FROM Municipalities WHERE Muni_Id = '$data'");
        $res = $db->getResult();

        foreach($res as $val) {
            $this->return_data = $val;
        }
    }        

    public function getImage() {
        $db = new Db();
        $db->connect();
        $data = $db->escapeString($this->data);
        $db->sql("SELECT * FROM Images WHERE Image_Id = '$data'");
        $this->return_data = $db->getResult();
    }

    public function showAdImage() {
        $db = new Db();
        $db->connect();
        $data = $db->escapeString($this->data);
        $db->sql("SELECT * FROM Images WHERE Ad_Id = '$data'");
        $this->return_data = $db->getResult();
    }

    public function getFacts() {
        $db = new Db();
        $db->connect();
        $data = $db->escapeString($this->data);
        $db->sql("SELECT * FROM Facts WHERE Fact_Id = '$data'");
        $res = $db->getResult();

        foreach($res as $val) {
            $this->return_data = $val;
        }
    }

    public function getContact() {
        $db = new Db();
        $db->connect();
        $data = $db->escapeString($this->data);
        $db->sql("SELECT * FROM Contact WHERE Contact_Id = '$data'");
        $res = $db->getResult();

        foreach($res as $val) {
            $this->return_data = $val;
        }
    }

    public function getCompany() {
        $db = new Db();
        $db->connect();
        $data = $db->escapeString($this->data);
        $db->sql("SELECT * FROM Companies WHERE Contact_Id = '$data'");
        $res = $db->getResult();

        foreach($res as $val) {
            $this->return_data = $val;
        }
    }
}

?>
