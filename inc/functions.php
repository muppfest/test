<?php

function belopp($x) {
    $x = round($x, -0);
    $price_array = str_split(strrev($x), 3);
	$price_nice = strrev(implode(" ", $price_array));
    return $price_nice;
}

function kvmpris($x, $y) {    
    $kvmpris = $x/$y;
    $kvmpris = round($kvmpris, -1);
    return $kvmpris;
}

function ad_count($x) {

    if($x > 1) {
        echo "<h4 class='ad-count'>" . $x . " träffar</h4>";
    }
    elseif($x == 1) {
        echo "<h4 class='ad-count'>" . $x . " träff</h4>";
    }else{
        echo "<h4 class='ad-count'>Inga träffar</h4>";
    }
}

function ad_show_contact($x) {
    foreach($x as $key => $val) {
            switch ($key) {
            
            case 'Name':
                if(isset($val)) {
                echo "<li>" . $val . "</li>";
                }else{ echo "";}
            break;            
            
            case 'Phone':
                if(isset($val)) {
                echo "<li><span class='glyphicon glyphicon-earphone'></span> " . $val . "</li>";
                }else{ echo "";}
            break;

            case 'Email':
                if(isset($val)) {
                echo "<li><span class='glyphicon glyphicon-envelope'></span><a href='mailto:" . $val . "'> " . $val . "</a></li>";
                }else{ echo "";}
            break;

            default: 
                if(empty($key)) {
                    break;
                }else{
                    break;
                }
            break;
    }
}
}

function ad_show_facts($x) {
    foreach($x as $key => $val) {
        switch ($key) {

            case 'Boarea':
                if(isset($val)) {
                echo "<li>Boarea: " . $val . " m&#178;</li>";
                }else{ echo "";}
            break;

            case 'Biarea':
                if(isset($val)) {
                echo "<li>Biarea: " . $val . " m&#178;</li>";
                }else{ echo "";}
            break;

            case 'Tomtarea':
                if(isset($val)) {
                echo "<li>Tomtarea: " . $val . " m&#178;</li>";
                }else{ echo "";}
            break;

            case 'Antal_Rum':
                if(isset($val)) {
                echo "<li>Antal rum: " . $val . "</li>";
                }else{ echo "";}
            break;

            case 'Driftkostnad':
                if(isset($val)) {
                echo "<li>Driftkostnad: " . belopp($val) . " kr/år</li>";
                }else{ echo "";}
            break;

            case 'Hyra':
                if(isset($val)) {
                echo "<li>Hyra: " . belopp($val) . " kr/mån</li>";
                }else{ echo "";}
            break;

            case 'Byggar':
                if(isset($val)) {
                echo "<li>Byggår: " . $val . "</li>";
                }else{ echo "";}
            break;

            default: 
                if(empty($key)) {
                    break;
                }else{
                    break;
                }
            break;
        }
    }
}

function ad_show_more_facts($x) {
            foreach($x as $key => $val) {

                switch ($key) {
            
            case 'Beteckning':
                if(isset($val)) {
                echo "<li>Beteckning: " . $val . "</li>";
                }else{ echo "";}
            break;

            case 'Pantbrev':
                if(isset($val)) {
                echo "<li>Pantbrev: " . belopp($val) . " kr</li>";
                }else{ echo "";}
            break;

            case 'Taxeringskod':
                if(isset($val)) {
                echo "<li>Taxeringskod: " . $val . "</li>"; 
                }else{ echo "";}
            break;

            case 'Taxeringsvarde':
                if(isset($val)) {
                echo "<li>Taxeringsvärde: " . belopp($val) . " kr</li>";
                }else{ echo "";}
            break;

            case 'Taxeringsar':
                if(isset($val)) {
                echo "Taxeringsår: " . $val;
                }else{ echo "";}
            break;    
            
            default: 
                if(empty($key)) {
                    break;
                }else{
                    break;
                }
            break;
            
            }
            }
}

function dateSortDesc($a, $b)
{
    if (strtotime($a['Date']) == strtotime($b['Date'])) {
        return 0;
    }
    return (strtotime($a['Date']) < strtotime($b['Date'])) ? 1 : -1;
}

function dateSortAsce($a, $b)
{
    if (strtotime($a['Date']) == strtotime($b['Date'])) {
        return 0;
    }
    return (strtotime($a['Date']) < strtotime($b['Date'])) ? -1 : 1;
}

function priceSortDesc($a, $b) {
    if($a['Price'] == $b['Price']) {
        return 0;
    }
    return ($a['Price'] < $b['Price']) ? 1 : -1;
}

function priceSortAsce($a, $b) {
    if($a['Price'] == $b['Price']) {
        return 0;
    }
    return ($a['Price'] < $b['Price']) ? -1 : 1;
}

function checkPage() {
    if(isset($_GET['page'])) {
        $page = $_GET['page'];
        return "?page=" . $page;
    }else{
        return "?page=ads";
    }
}


function postCheck() {
    
    $link = "";

    foreach($_GET as $key => $value){
        
   if(isset($value)){
        unset($_GET['pnumber']);
      $link = $link . $key . '=' . $value .'&';
   }else{
      $link = "";
   }

}

return $link;

}

function paginator($pagenumber, $totalpages) {

    if(postCheck()) {
        $link = '?' . postCheck() . 'pnumber=%d';
    }else{
        $link = '?pnumber=%d';
    } 
$pagerContainer = '<div style="width: 300px;">';   
if( $totalpages != 0 ) 
{
  if( $pagenumber == 1 ) 
  { 
    $pagerContainer .= ''; 
  } 
  else 
  { 
    $pagerContainer .= sprintf( '<a href="' . $link . '"> &#171; Föregående sida</a>', $pagenumber - 1 ); 
  }
  $pagerContainer .= ' <span> page <strong>' . $pagenumber . '</strong> from ' . $totalpages . '</span>'; 
  if( $pagenumber == $totalpages ) 
  { 
    $pagerContainer .= ''; 
  }
  else 
  { 
    $pagerContainer .= sprintf( '<a href="' . $link . '"> Nästa sida &#187; </a>', $pagenumber + 1 ); 
  }           
}                   
$pagerContainer .= '</div>';

echo $pagerContainer;

}

?>