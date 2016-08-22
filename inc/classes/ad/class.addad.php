<?php

class AddAd extends Db {

    static $return_data;
    static $last_id;
    private $message;
   
    public function checkAdSession() {
        if(isset($_SESSION['ad_id'])) {
            return true;
        }else{
            return false;
            
        }
    }

    public function newAdSession() {
            $db = new Db();
            $db->connect();
            $date = $db->escapeString(date("Y-m-d H:i:s"));
            $ip_address = $db->escapeString($_SERVER['REMOTE_ADDR']);
            $db->insert('Ads',array('IpAddress'=>$ip_address, 'Date'=>$date));
            
            $_SESSION['ad_id'] = $db->getLastInsertId();
            $this->return_data = $db->getResult();           
    }

    public function deleteAdSession() {
            $db = new Db();
            $db->connect();
        if($this->checkAdSession()) {               
            unset($_SESSION['ad_id']);
        }else{
            return false;
        }
    }

    public function addImages($data) {
            $db = new Db();
            $db->connect();

            $ad_id = $db->escapeString($_SESSION['ad_id']);
            $date = $db->escapeString(date("Y-m-d H:i:s"));
            $data = $db->escapeString($data);

            $db->insert('Images',array('Name'=>$data,'Ad_Id'=>$ad_id,'Date'=>$date));
            $this->return_data = $db->getResult();

    }

    public function deleteImages($data) {
            $db = new Db();
            $db->connect();

            $data = $db->escapeString($data);
            $ad_id = $db->escapeString($_SESSION['ad_id']);

            $db->sql("DELETE FROM Images WHERE Ad_Id = '$ad_id' AND Name = '$data'");
            $this->return_data = $db->getResult();
    }

    public function adAdd($data) {
            $db = new Db();
            $db->connect();

            $ad_id = $db->escapeString($_SESSION['ad_id']);

            $db->update('Ads', $data, 'Ad_Id ='.$ad_id);
            $this->return_data = $db->getResult();
    }

    public function addContact($data) {
                $db = new Db();
                $db->connect();
                
                $db->insert('Contact', $data);
                $this->return_data = $db->getResult();
                $this->last_id = $db->getLastInsertId();
    }

    public function addCompany($data) {
                $db = new Db();
                $db->connect();
                               
                $db->insert('Companies', $data);
                $this->return_data = $db->getResult();
    }
   
    public function addIndividual($data) {
                $db = new Db();
                $db->connect();
                                
                $db->insert('Individuals', $data);
                $this->return_data = $db->getResult();
    }
    
    public function returnMessage() {
            $val = $this->message;
            return $val;
    }

    public function deleteEmptyRows() {
        $db = new Db();
        $db->connect();
        $db->sql("DELETE FROM Ads WHERE Date < NOW() - INTERVAL 24 MINUTE AND Name IS NULL");
        $this->return_data = $db->getResult();
    }

}

?>
