<?php
require($tpl_path . "header.tpl.php");
require($tpl_path . "nav.tpl.php");
require($tpl_path . "searchnav.tpl.php");
                
    $aid = $_GET['aid'];

    $ad = new Ad($aid);
    $ad->getAd();
    
    if(!isset($ad->return_data)){
        echo "<h3>Annonsen kunde inte hittas.</h3>";
    }else{
    
    $ad_data = $ad->return_data;

                $cat_id = $ad_data['Cat_Id'];
                $cat = new Ad($cat_id);
                $cat->getCat();
                $cat_result = $cat->return_data;
                
                $type_id = $ad_data['Type_Id'];
                $type = new Ad($type_id);
                $type->getType();
                $type_result = $type->return_data;

                $state_id = $ad_data['State_Id'];
                $state = new Ad($state_id);
                $state->getState();
                $state_result = $state->return_data;

                $muni_id = $ad_data['Muni_Id'];
                $muni = new Ad($muni_id);
                $muni->showMuni();
                $muni_result = $muni->return_data;

                $ad_id = $ad_data['Ad_Id'];
                $images = new Ad($ad_id);
                $images->showAdImage();
                $image_result = $images->return_data;

                $fact_id = $ad_data['Fact_Id'];
                $facts = new Ad($fact_id);
                $facts->getFacts();
                $facts_result = $facts->return_data;

                $contact_id = $ad_data['Contact_Id'];
                $contact = new Ad($contact_id);
                $contact->getContact();
                $contact_result = $contact->return_data;
    
    echo "<div class='row ad-carousel'>";
    echo "<div class='col-sm-12'>";
    echo "<div id='myCarousel' class='carousel slide'>";
    echo "<ol class='carousel-indicators'>";

                $i = 0;
                    foreach($image_result as $val) {

                        echo "<li data-target='#myCarousel' data-slide-to='" . $i . "'"; 
                    if($i == 0) { echo " class='active'"; }else{ echo "";}
                        echo "></li>";
                $i++;
             }

    echo "</ol><div class='carousel-inner' role='listbox'>";
                
                $x = 0;
                foreach($image_result as $val) {
                    echo "<div class='item";
                    if($x == 0) { echo " active"; }else{ echo "";}
                    echo "'>";
                    echo "<img src='" . $img_content_path . "uploads/" . $val['Name'] . "' class='img-responsive'>";
                    echo "</div>";
                $x++;
                }
    echo "</div>";

    echo '<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>';
    echo "</div></div>";


        echo "<div class='col-sm-9'>";
            echo "<h3 class='ad-title'>" . $ad_data['Title'] . "</h3>";
            echo "<h5 class='ad-location'>" . $state_result['Name'] . ", " . $muni_result['Name'] . "</h5>";
        echo "</div>";
        echo "<div class='col-sm-3'>";
            echo "<h3 class='ad-price'>" . belopp($ad_data['Price']) . " kr</h3>";
        echo "</div>";

        echo "<div class='col-sm-9'>";
                echo "<p class='ad-description'>" . $ad_data['Description'] . "</p>";
        if(isset($ad_data['Link'])) {
                echo "<p><a href='" . $ad_data['Link'] . "' target='_blank' class='btn btn-readmore' role='button'>" . "Läs mer om objektet här</a></p>";
        }else{
            echo "";
        }

        echo "</div>";
        echo "<div class='col-sm-3'>";
            echo "<ul class='facts'>";
            echo "<h4>Fakta</h4>";
            echo "<li>Typ: " . $cat_result['Name'] . "</li>";
                ad_show_facts($facts_result);
            echo "</ul>";
            echo "<ul class='facts'>";
                ad_show_more_facts($facts_result);
            echo "</ul>";
        echo "</div>";
        echo "<div class='col-sm-9'>";
                echo "<ul class='contact'>";
                echo "<h4>Kontakt</h4>";
                echo "<p>" . ad_show_contact($contact_result) . "</p>";
                echo "</ul>";
        echo "</div>";
        echo "<div class='col-sm-3'></div>";
    echo "</div>";
    }

require($tpl_path . "banners.tpl.php");              
require($tpl_path . "footer.tpl.php");

?>