<?php

session_start();

$addad = new AddAd();

if($addad->checkAdSession()) {
    
}else{
    $addad->newAdSession();
}

if(isset($_POST['state'])) {
    $sid = $_POST['state'];

    $muni_nav = new Ad($sid);
    $muni_nav->showMuni();
    $muni_navitems = $muni_nav->return_data;

}

if(isset($_POST['postAd'])) {

    if(!$_POST['name'] || !$_POST['email'] || !$_POST['email-confirm'] || !$_POST['phone'] || !$_POST['state'] || !$_POST['muni'] || !$_POST['zipcode'] || !$_POST['city'] || !$_POST['cat'] || !$_POST['type'] || !$_POST['title'] || !$_POST['text'] || !$_POST['price'] || !$_POST['password'] || !$_POST['password-confirm']) {
        $message = "Alla fält måste fyllas i.";
    }else { 
    
    if($_POST['radio-contact'] == 0) {
    
    $ad_id = $_SESSION['ad_id'];

    $name = $_POST['name'];
    $email = $_POST['email'];
    $email_confirm = $_POST['email-confirm'];
    $phone = $_POST['phone'];
    $state = $_POST['state'];
    $muni = $_POST['muni'];
    $zipcode = $_POST['zipcode'];
    $city = $_POST['city'];
    $cat = $_POST['cat'];
    $type = $_POST['type'];
    $title = $_POST['title'];
    $text = $_POST['text'];
    $price = $_POST['price'];
    $pw = $_POST['password'];
    $pw_confirm = $_POST['password-confirm'];
    $term_confirm = $_POST['agreements'];

    if($pw != $pw_confirm) {
        $message = "Lösenorden måste stämma överens.";
    }else{
        if($email != $email_confirm) {
            $message = "E-postadresserna måste stämma överens.";
        }else{
            if($term_confirm != "yes") {
                $message = "Ni måste acceptera användarvillkoren för att lägga in annonsen.";
            }else{
                $pw_hash = password_hash($pw, PASSWORD_BCRYPT);
                $contact = array('Zipcode'=>$zipcode,'City'=>$city,'Phone'=>$phone,'Email'=>$email,'Password_hash'=>$pw_hash,'Company'=>'0');
                
                $addcontact = new AddAd();
                $addcontact->addContact($contact);

                $contact_id = $addcontact->last_id;
                $individual = array('Name'=>$name,'Contact_Id'=>$contact_id);
                $addindividual = new AddAd();
                $addindividual->addIndividual($individual);

                $ad = array('Title'=>$title,'Type_Id'=>$type,'Price'=>$price,'Description'=>$text,'Cat_Id'=>$cat,'Activated'=>'0','State_Id'=>$state,'Contact_Id'=>$contact_id);
                $adadd = new AddAd();
                $adadd->adAdd($ad);

                $adadd->deleteAdSession();

        }
    }
    }

    }else{
        $name = $_POST['name'];
        $orgnumber = $_POST['orgnumber'];
        $email = $_POST['email'];
        $email_confirm = $_POST['email-confirm'];
        $phone = $_POST['phone'];
        $state = $_POST['state'];
        $muni = $_POST['muni'];
        $zipcode = $_POST['zipcode'];
        $city = $_POST['city'];
        $cat = $_POST['cat'];
        $type = $_POST['type'];
        $title = $_POST['title'];
        $text = $_POST['text'];
        $price = $_POST['price'];
        $pw = $_POST['password'];
        $pw_confirm = $_POST['password-confirm'];
        $term_confirm = $_POST['agreements'];

    if($pw != $pw_confirm) {
        $message = "Lösenorden måste stämma överens.";
    }else{
        if($email != $email_confirm) {
            $message = "E-postadresserna måste stämma överens.";
        }else{
            if($term_confirm != "yes") {
                $message = "Ni måste acceptera användarvillkoren för att lägga in annonsen.";
            }else{
                $pw_hash = password_hash($pw, PASSWORD_BCRYPT);
                $contact = array('Zipcode'=>$zipcode,'City'=>$city,'Phone'=>$phone,'Email'=>$email,'Password_hash'=>$pw_hash,'Company'=>'1');
                
                $addcontact = new AddAd();
                $addcontact->addContact($contact);

                $contact_id = $addcontact->last_id;
                $company = array('Name'=>$name,'Orgnumber'=>$orgnumber,'Contact_Id'=>$contact_id);
                $addcompany = new AddAd();
                $addcompany->addCompany($company);

                $ad = array('Title'=>$title,'Type_Id'=>$type,'Price'=>$price,'Description'=>$text,'Cat_Id'=>$cat,'Activated'=>'0','State_Id'=>$state,'Contact_Id'=>$contact_id);
                $adadd = new AddAd();
                $adadd->adAdd($ad);

                $adadd->deleteAdSession();

        }
    }
    }

    }
}   
} 

?>
