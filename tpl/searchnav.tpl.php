        <div class="container">
            <div class="row search-nav">
            <form action="?page=search" method="get" class="form-inline">
            <center>
            <div class="row form-search">
            <div class="form-group">
                <input type="text" class="form-control" name="stext" value="<?php if(isset($search_text)) { echo $search_text; }?>"> 
                </div>
            <div class="form-group">
                <select name="scat" class="form-control">
                <option value="0"> Alla bostadstyper</option>
               
                <?php               
                if(isset($_GET['scat'])) {
                    
                    foreach($cat_navitems as $val) {
                        echo "<option value='" . $val['Cat_Id'] . "' ";
                    
                    if($_GET['scat'] == $val['Cat_Id']) {
                        echo "selected>" . $val['Name'] . "</option>";
                    }
                    else {
                        echo ">" . $val['Name'] . "</option>";
                    }
                }
                }
                else {
                    
                foreach($cat_navitems as $val) {
                    echo "<option value='" . $val['Cat_Id'] . "'>" . $val['Name'] . "</option>";
                }
                }
                ?>
                
                </select>   
            </div>

            <div class="form-group">
                <select name="sstate" class="form-control">
                <option value="0"> Hela Sverige</option>       
                <?php
                if(isset($_GET['sstate'])) {

                    foreach($state_navitems as $val) {
                        echo "<option value='" . $val['State_Id'] . "' ";
                    
                    if($_GET['sstate'] == $val['State_Id']) {
                    echo "selected>" . $val['Name'] . "</option>";
                    }
                    else {
                        echo ">" . $val['Name'] . "</option>";
                    }
                }
                }
                    else {
                    foreach($state_navitems as $val) {
                        echo "<option value='" . $val['State_Id'] . "'>" . $val['Name'] . "</option>";
                    }
                }
                ?>                  
                </select>
            </div> 
            <div class="form-group">
                <button type="submit" class="btn btn-search"><span class="glyphicon glyphicon-search"></span></button>
            </div>
            </div>
   
        
            <div class="form-group form-radio">
                <ul>
                <li><label for="r0"><input type="radio" name="stype" value="0" id="r0" <?php if(isset($_GET['stype'])) { if($_GET['stype'] == 0) { echo "checked"; } } ?>> Alla</label></li>
         <?php
                if(isset($_GET['stype'])) {
                    foreach($type_navitems as $val) {
                    echo "<li><label for='r" . $val['Type_Id'] . "'><input type='radio' name='stype' value='" . $val['Type_Id'] . "' id='r" . $val['Type_Id']; 
                    if($_GET['stype'] == $val['Type_Id']) {
                        echo "' checked='checked'> " . $val['Name'] . "</label></li>";
                    }
                    else {
                        echo "'> " . $val['Name'] . "</label></li>";
                    }
                }
                }
                else {
                foreach($type_navitems as $val) {
                    echo "<li><label for='r" . $val['Type_Id'] . "'><input type='radio' name='stype' value='" . $val['Type_Id'] . "' id='r" . $val['Type_Id'] . "'> " . $val['Name'] . "</label></li>";
                }
                }
         ?>   
                </ul>
               
            </div>
                </center>
            </form>
    

    </div>

</div>

<div class="container">
<div class="row">
<div class="col-sm-9 catnav">