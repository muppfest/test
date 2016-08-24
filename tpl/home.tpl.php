<?php
require($tpl_path . "header.tpl.php");
require($tpl_path . "nav.tpl.php");
require($tpl_path . "searchnav.tpl.php");

    
                echo "<div class='row'><div class='col-sm-9'>";

                ad_count($search_count);
                
                echo "</div><div class='col-sm-3'>";

                echo "<form method='get'>";
                echo "<div class='form-group'><select name='sort' class='form-control' onchange='this.form.submit()'>";

                echo "<option value='1'"; 
                    if(!isset($_GET['sort'])) { echo " selected";}else{echo "";}
                echo ">Nyast först</option>";
                echo "<option value='2'>Äldst först</option></select></form></div>";
                
                echo "</div></div>";

                if(empty($search_result)) {
                    echo "";
                }

                else {
                
                $pagenumber = !empty($_GET['pnumber']) ? (int) $_GET['pnumber'] : 1;
                $total = $search_count;
                $limit = 1;
                $totalpages = ceil($total/$limit);
                $pagenumber = max($pagenumber, 1);
                $pagenumber = min($pagenumber, $totalpages);
                $offset = ($pagenumber - 1) * $limit;
                if($offset < 0) $offset = 0;

                $search_result = array_slice($search_result, $offset, $limit);                               

                foreach($search_result as $val) {

                $cat_id = $val['Cat_Id'];
                $cat = new Ad($cat_id);
                $cat->getCat();
                $cat_result = $cat->return_data;
                
                $type_id = $val['Type_Id'];
                $type = new Ad($type_id);
                $type->getType();
                $type_result = $type->return_data;

                $state_id = $val['State_Id'];
                $state = new Ad($state_id);
                $state->getState();
                $state_result = $state->return_data;

                $ad_id = $val['Ad_Id'];
                $images = new Ad($ad_id);
                $images->showAdImage();
                $image_result = $images->return_data;

                $fact_id = $val['Fact_Id'];
                $facts = new Ad($fact_id);
                $facts->getFacts();
                $facts_result = $facts->return_data;

                echo "<div class='row ad-row'><div class='col-sm-4 col-xs-12'>";

                        if(empty($image_result)) {
                            echo "";
                        }
                        else {
                            echo "<a href='?page=ad&aid=" . $val['Ad_Id'] . "'><img class='img-responsive' src='" . $img_content_path . "uploads/" . $image_result[0]['Name'] . "'></a>";
                        }

                echo "</div>";
                echo "<div class='col-sm-8 col-xs-12'><ul class='info'><li><p><a href='?scat=" . $cat_result['Cat_Id'] . "'><h4 class=''>" . $cat_result['Name'] . "</a>, <a href='?sstate=" . $state_result['State_Id'] . "'>"  . $state_result['Name'] . "</h4></a></p><p><a href='?page=ad&aid=" . $val['Ad_Id'] . "'><h3>" . $val['Title'] . "</h3></a></p></li>";
                echo "<p>" . mb_strimwidth($val['Description'], 0, 150, "...");
                echo "<li><p><h3 class='price'>" . belopp($val['Price']) . " kr</h3></p></li>";

                echo "<p><li>". $facts_result['Boarea'] ." m&#178, " . $facts_result['Antal_Rum'] . " rum</li>";
                        
                        if(!empty($facts_result['Hyra'])) {
                            echo "<li>" . belopp(kvmpris($val['Price'], $facts_result['Boarea'])) . " kr/m&#178;</li>";
                            echo "<li>" . belopp($facts_result['Hyra']) . " kr/mån</li>";
                        }else if(!empty($facts_result['Driftkostnad'])){
                            echo "<li>" . belopp($facts_result['Tomtarea']) . " m&#178; tomt</li>";
                            echo "<li>" . belopp($facts_result['Driftkostnad']) . " kr/år</li>";
                        }else{
                            echo "";
                        } 
                
                echo "</p></ul></div></div>";



                }

            paginator($pagenumber, $totalpages);
                
            }





require($tpl_path . "banners.tpl.php");              
require($tpl_path . "footer.tpl.php");

?>