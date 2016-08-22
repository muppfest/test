<?php

class AdSearch extends Db {
    
    static $return_data;
    static $message;
    static $ad_count;
    
    private $search_text;
    private $search_type;
    private $search_cid;
    private $search_state;

    public function  __construct($search_text, $search_type, $search_cid, $search_state) {
        if(isset($search_text)) {
            $this->search_text = $search_text;
        }
        if(isset($search_type)) {
            $this->search_type = $search_type;
        }
        if(isset($search_cid)) {
            $this->search_cid = $search_cid;
        }
        if(isset($search_state)) {
            $this->search_state = $search_state;
        }
    }

    public function searchAd() {
        $db = new Db();
        $db->connect();

        if(!empty($this->search_type && $this->search_cid && $this->search_state)) {
            $search_text = $db->escapeString(trim($this->search_text));
            $search_type = $db->escapeString($this->search_type);
            $search_cid = $db->escapeString($this->search_cid);
            $search_state = $db->escapeString($this->search_state);

            $db->sql("SELECT * FROM Ads WHERE Title LIKE '%$search_text%' AND Activated > 0 AND Type_Id = '$search_type' AND Cat_Id = '$search_cid' AND State_Id = '$search_state' OR Description LIKE '%$search_text%' AND Activated > 0 AND Type_Id = '$search_type' AND Cat_Id = '$search_cid' AND State_Id = '$search_state' OR Price LIKE '%$search_text%' AND Activated > 0 AND Type_Id = '$search_type' AND Cat_Id = '$search_cid' AND State_Id = '$search_state' ORDER BY Date DESC");
            $this->return_data = $db->getResult();
            $this->ad_count = $db->numRows();
        }

        elseif(!empty($this->search_type && $this->search_cid)) {
            $search_text = $db->escapeString(trim($this->search_text));
            $search_type = $db->escapeString($this->search_type);
            $search_cid = $db->escapeString($this->search_cid);

            $db->sql("SELECT * FROM Ads WHERE Title LIKE '%$search_text%' AND Activated > 0 AND Type_Id = '$search_type' AND Cat_Id = '$search_cid' OR Description LIKE '%$search_text%' AND Activated > 0 AND Type_Id = '$search_type' AND Cat_Id = '$search_cid' OR Price LIKE '%$search_text%' AND Activated > 0 AND Type_Id = '$search_type' AND Cat_Id = '$search_cid' ORDER BY Date DESC");
            $this->return_data = $db->getResult();
            $this->ad_count = $db->numRows();
        }

        elseif(!empty($this->search_cid && $this->search_state)) {
            $search_text = $db->escapeString(trim($this->search_text));
            $search_state = $db->escapeString($this->search_state);
            $search_cid = $db->escapeString($this->search_cid);

            $db->sql("SELECT * FROM Ads WHERE Title LIKE '%$search_text%' AND Activated > 0 AND State_Id = '$search_state' AND Cat_Id = '$search_cid' OR Description LIKE '%$search_text%' AND Activated > 0 AND State_Id = '$search_state' AND Cat_Id = '$search_cid' OR Price LIKE '%$search_text%' AND Activated > 0 AND State_Id = '$search_state' AND Cat_Id = '$search_cid' ORDER BY Date DESC");
            $this->return_data = $db->getResult();
            $this->ad_count = $db->numRows();
        }

        elseif(!empty($this->search_type && $this->search_state)) {
            $search_text = $db->escapeString(trim($this->search_text));
            $search_state = $db->escapeString($this->search_state);
            $search_type = $db->escapeString($this->search_type);

            $db->sql("SELECT * FROM Ads WHERE Title LIKE '%$search_text%' AND Activated > 0 AND State_Id = '$search_state' AND Type_Id = '$search_type' OR Description LIKE '%$search_text%' AND Activated > 0 AND State_Id = '$search_state' AND Type_Id = '$search_type' OR Price LIKE '%$search_text%' AND Activated > 0 AND State_Id = '$search_state' AND Type_Id = '$search_type' ORDER BY Date DESC");
            $this->return_data = $db->getResult();
            $this->ad_count = $db->numRows();
        }

        elseif(!empty($this->search_type)) {
            $search_text = $db->escapeString(trim($this->search_text));
            $search_type = $db->escapeString($this->search_type);

            $db->sql("SELECT * FROM Ads WHERE Title LIKE '%$search_text%' AND Activated > 0 AND Type_Id = '$search_type' OR Description LIKE '%$search_text%' AND Activated > 0 AND Type_Id = '$search_type' OR Price LIKE '%$search_text%' AND Activated > 0 AND Type_Id = '$search_type' ORDER BY Date DESC");
            $this->return_data = $db->getResult();
            $this->ad_count = $db->numRows();   
        }

        elseif(!empty($this->search_cid)) {
            $search_text = $db->escapeString(trim($this->search_text));
            $search_cid = $db->escapeString($this->search_cid);

            $db->sql("SELECT * FROM Ads WHERE Title LIKE '%$search_text%' AND Activated > 0 AND Cat_Id = '$search_cid' OR Description LIKE '%$search_text%' AND Activated > 0 AND Cat_Id = '$search_cid' OR Price LIKE '%$search_text%' AND Activated > 0 AND Cat_Id = '$search_cid' ORDER BY Date DESC");
            $this->return_data = $db->getResult();
            $this->ad_count = $db->numRows();    
        }

        elseif(!empty($this->search_state)) {
            $search_text = $db->escapeString(trim($this->search_text));
            $search_state = $db->escapeString($this->search_state);

            $db->sql("SELECT * FROM Ads WHERE Title LIKE '%$search_text%' AND Activated > 0 AND State_Id = '$search_state' OR Description LIKE '%$search_text%' AND Activated > 0 AND State_Id = '$search_state' OR Price LIKE '%$search_text%' AND Activated > 0 AND State_Id = '$search_state' ORDER BY Date DESC");
            $this->return_data = $db->getResult();
            $this->ad_count = $db->numRows();    
        }

        else {
            $search_text = trim($this->search_text);
            $search_text = $db->escapeString($search_text);
            $db->sql("SELECT * FROM Ads WHERE Title LIKE '%$search_text%' AND Activated > 0 OR Description LIKE '%$search_text%' AND Activated > 0 OR Price LIKE '%$search_text%' AND Activated > 0 ORDER BY Date DESC");
            $this->return_data = $db->getResult();
            $this->ad_count = $db->numRows();
        }
    }

}

?>
