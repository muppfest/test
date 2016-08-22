<?php

    if(isset($_GET['stext'])) {
        $search_text = $_GET['stext'];
    }
    else {
        $search_text = "";
    }
    
    if(isset($_GET['scat'], $_GET['stype'], $_GET['sstate'])) {
        $search_state = $_GET['sstate'];
        $search_cid = $_GET['scat']; 
        $search_type = $_GET['stype'];
        $search = new AdSearch($search_text, $search_type, $search_cid, $search_state);
    }
    elseif(isset($_GET['stype'], $_GET['scat'])) {
        $search_type = $_GET['stype'];
        $search_cid = $_GET['scat']; 
        $search = new AdSearch($search_text, $search_type, $search_cid, null);
    }
    elseif(isset($_GET['scat'], $_GET['sstate'])) {
        $search_cid = $_GET['scat'];
        $search_state = $_GET['sstate'];
        $search = new AdSearch($search_text, null, $search_cid, $search_state);
    }
    elseif(isset($_GET['stype'], $_GET['sstate'])) {
        $search_type = $_GET['stype'];
        $search_state = $_GET['sstate'];
        $search = new AdSearch($search_text, $search_type, null, $search_state);
    }
    elseif(isset($_GET['scat'])) {
        $search_cid = $_GET['scat'];
        $search = new AdSearch($search_text, null, $search_cid, null);
    }
    elseif(isset($_GET['stype'])) {
        $search_type = $_GET['stype'];
        $search = new AdSearch($search_text, $search_type, null, null);
    }
    elseif(isset($_GET['sstate'])) {
        $search_state = $_GET['sstate'];
        $search = new AdSearch($search_text, null, null, $search_state);
    }
    else {
        $search = new AdSearch($search_text, null, null, null);
    }

    $search->searchAd();

    $search_result = $search->return_data;
    $search_count = $search->ad_count;

?>
