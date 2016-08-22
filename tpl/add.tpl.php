<?php
require($tpl_path . "header.tpl.php");
require($tpl_path . "nav.tpl.php");

?>

                <form action="" method="post" enctype="multipart/form-data">
<div class="container">
<div class="row">
<div class="col-sm-9 catnav">
                <div class="col-sm-12"><h3>Lägg in annons</h3>
            

                <div class="form-group form-radio-add">
                    <ul>
                    <li><label for="c1"><input type="radio" name="radio-contact" value="0" id="c1" onclick="this.form.submit()" <?php if(isset($_POST['radio-contact'])) { if($_POST['radio-contact'] == 0) { echo "checked";}}?>> Privatperson</label></li>
                    <li><label for="c2"><input type="radio" name="radio-contact" value="1" id="c2" onclick="this.form.submit()" <?php if(isset($_POST['radio-contact'])) { if($_POST['radio-contact'] == 1) { echo "checked";}}?>> Företag</label></li>
                    </ul>
                </div>
                    </div>
<div class="col-sm-4">

    <?php if(!isset($_POST['radio-contact']) || $_POST['radio-contact'] == 0) {?>
                
                <div class="form-group">
                    <label for="name">Namn</label>
                    <input type="text" class="form-control" name="name" id="name" <?php if(isset($_POST['name'])) { echo "value='" . $_POST['name'] . "'"; } ?> >
                </div>
                <div class="form-group">
                    <label for="email">E-post</label>
                    <input type="email" class="form-control" id="email" name="email" <?php if(isset($_POST['email'])) { echo "value='" . $_POST['email'] . "'"; } ?> >
                </div>
                <div class="form-group">
                    <label for="email-confirm">Upprepa E-post</label>
                    <input type="email" class="form-control" id="email-confirm" name="email-confirm" <?php if(isset($_POST['email-confirm'])) { echo "value='" . $_POST['email-confirm'] . "'"; } ?> >
                </div>
                <div class="form-group">
                    <label for="phone">Telefon</label>
                    <input type="text" class="form-control" id="phone" name="phone" <?php if(isset($_POST['phone'])) { echo "value='" . $_POST['phone'] . "'"; } ?> >
                </div>
                <div class='form-group'><label for='state'>Län</label>
                <select name='state' class='form-control' onchange='this.form.submit()' id='state'>
                <option value='' selected disabled>Välj län</option>

<?php 

                 if(isset($_POST['state'])) { 

                 foreach($state_navitems as $val) {
                     echo "<option value='" . $val['State_Id'];

                     if($_POST['state'] == $val['State_Id']) {
                         echo "' selected>" . $val['Name'] . "</option>";
                     }
                     else {
                         echo "'>" . $val['Name'] . "</option>";
                     }
                 }
                 }
                 else {
                 foreach($state_navitems as $val) {
                     echo "<option value='" . $val['State_Id'] . "'>" . $val['Name'] . "</option>";
                 }
                 }
                 echo "</select></div>";
                    echo "<div class='form-group'><label for='muni'>Kommun</label>";
                    echo "<select name='muni' class='form-control' id='muni'>";
                    echo "<option value='' selected disabled>Välj kommun</option>";
                
                if(isset($_POST['state'])) {

                    if(isset($_POST['muni'], $_POST['state'])) {

                        foreach($muni_navitems as $val) {
                        echo "<option value='" . $val['Muni_Id'];

                        if($_POST['muni'] == $val['Muni_Id']) {
                            echo "' selected>" . $val['Name'] . "</option>";
                        }
                        else {
                            echo "'>" . $val['Name'] . "</option>";
                        }
                        }
                    }

                    else {
                 foreach($muni_navitems as $val) {
                    echo "<option value='" . $val['Muni_Id'] . "'>" . $val['Name'] . "</option>";
                    }
                  }
                }
?>
                    </select></div>
                <div class="form-group">
                    <label for="zipcode">Postnummer</label>
                    <input type="text" class="form-control" id="zipcode" name="zipcode" <?php if(isset($_POST['zipcode'])) { echo "value='" . $_POST['zipcode'] . "'"; } ?> >
                </div>
                <div class="form-group">
                    <label for="city">Ort</label>
                    <input type="text" class="form-control" id="city" name="city" <?php if(isset($_POST['city'])) { echo "value='" . $_POST['city'] . "'"; } ?> >
                </div>
</div>
<div class="col-sm-4">
                <div class='form-group'><label for='cat'>Kategori</label>
                <select class='form-control' name='cat' id='cat'>
                <option value='' selected disabled>Välj kategori</option>
          
<?php
                    foreach($cat_navitems as $val) {
                        echo "<option value='" . $val['Cat_Id'] . "' "; if(isset($_POST['cat'])) { if($_POST['cat'] == $val['Cat_Id']) {echo "selected"; }}
                        echo ">" . $val['Name'] . "</option>";
                    }
?>                
                    </select></div>
                 <div class='form-group form-radio-add'><ul><li><label for='t1'><input type='radio' name='type' id='t1' value='1'> Säljes</label></li>
                 <li><label for='t2'><input type='radio' name='type' id='t2' value='2'> Köpes</label></li>
                 <li><label for='t3'><input type='radio' name='type' id='t3' value='3'> Bytes</label></li>
                 <li><label for='t4'><input type='radio' name='type' id='t4' value='4'> Uthyres</label></li>
                 <li><label for='t5'><input type='radio' name='type' id='t5' value='5'> Önskar hyra</label></li></ul></div>
                 
    
                <div class="form-group">
                    <label for="title">Rubrik</label>
                    <input type="text" class="form-control" id="title" name="title" <?php if(isset($_POST['title'])) { echo "value='" . $_POST['title'] . "'"; } ?> >
                </div>
                <div class="form-group">
                <label for="text">Text</label>
                <textarea class="form-control" rows="12" id="text" name="text"><?php if(isset($_POST['text'])) { echo $_POST['text']; } ?></textarea>
                </div>
                <div class="form-group">
                    <label for="price">Pris</label>
                    <div class="input-group">
                    <input type="text" class="form-control" id="price" name="price" <?php if(isset($_POST['price'])) { echo "value='" . $_POST['price'] . "'"; } ?> >
                    <span class="input-group-addon">kr</span>
                        </div>
                </div>
</div>
<div class="col-sm-4">
                    <?php                         
                        if(isset($uploadmessage)) {
                            echo $uploadmessage;
                        }
                        if(isset($images)) {
                            foreach($images as $val) {
        
                            echo "<img class='img-responsive' src='" . $val . "'>";
                            }
                        }
                    ?>
                <div class="form-group">
                    <label for="password">Lösenord</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                <div class="form-group">
                    <label for="password">Upprepa lösenord</label>
                    <input type="password" class="form-control" name="password-confirm" id="password">
                </div>

                    <div class="form-group">
                    <label>Bilder</label>
                </div>        
                        <div class="form-group">
                     <input type="file" name="files[]" id="filer_input2" multiple="multiple">
                        </div>
                <div class="form-group">
                    <label for="agreements">Godkänn villkor</label></br>
                    <input type="checkbox" name="agreements" id="agreements" value="yes"> Jag godkänner användarvillkor och personuppgiftshantering
                </div>

                    <?php 
                    if(isset($message)) {
                            echo "<div class='form-group'>";
                            echo "<h4 class='danger'>" . $message . "</h4>";
                            echo "</div>";
                        }
                    ?>               

                <div class="form-group">
                    <button class="btn form-control" id="postAd" name="postAd" onclick="this.form.submit();">Lägg in annonsen</button>
                </div>

                <div class="form-group">     

                </div>
</div>  
                </form>

<?php

require($tpl_path . "banners.tpl.php");
require($tpl_path . "footer.tpl.php");

 }else{
     
?>


                <div class="form-group">
                    <label for="name">Företagsnamn</label>
                    <input type="text" class="form-control" name="name" id="name" <?php if(isset($_POST['name'])) { echo "value='" . $_POST['name'] . "'"; } ?> >
                </div>
                <div class="form-group">
                    <label for="orgnumber">Organisationsnummer</label>
                    <input type="text" class="form-control" name="orgnumber" id="orgnumber" <?php if(isset($_POST['orgnumber'])) { echo "value='" . $_POST['orgnumber'] . "'"; } ?> >
                </div>
                <div class="form-group">
                    <label for="email">E-post</label>
                    <input type="email" class="form-control" id="email" name="email" <?php if(isset($_POST['email'])) { echo "value='" . $_POST['email'] . "'"; } ?> >
                </div>
                <div class="form-group">
                    <label for="email-confirm">Upprepa E-post</label>
                    <input type="email" class="form-control" id="email-confirm" name="email-confirm" <?php if(isset($_POST['email-confirm'])) { echo "value='" . $_POST['email-confirm'] . "'"; } ?> >
                </div>
                <div class="form-group">
                    <label for="phone">Telefon</label>
                    <input type="text" class="form-control" id="phone" name="phone" <?php if(isset($_POST['phone'])) { echo "value='" . $_POST['phone'] . "'"; } ?> >
                </div>
                <div class='form-group'><label for='state'>Län</label>
                <select name='state' class='form-control' onchange='this.form.submit()' id='state'>
                <option value='' selected disabled>Välj län</option>

<?php 

                 if(isset($_POST['state'])) { 

                 foreach($state_navitems as $val) {
                     echo "<option value='" . $val['State_Id'];

                     if($_POST['state'] == $val['State_Id']) {
                         echo "' selected>" . $val['Name'] . "</option>";
                     }
                     else {
                         echo "'>" . $val['Name'] . "</option>";
                     }
                 }
                 }
                 else {
                 foreach($state_navitems as $val) {
                     echo "<option value='" . $val['State_Id'] . "'>" . $val['Name'] . "</option>";
                 }
                 }
                 echo "</select></div>";
                    echo "<div class='form-group'><label for='muni'>Kommun</label>";
                    echo "<select name='muni' class='form-control' id='muni'>";
                    echo "<option value='' selected disabled>Välj kommun</option>";
                
                if(isset($_POST['state'])) {

                    if(isset($_POST['muni'], $_POST['state'])) {

                        foreach($muni_navitems as $val) {
                        echo "<option value='" . $val['Muni_Id'];

                        if($_POST['muni'] == $val['Muni_Id']) {
                            echo "' selected>" . $val['Name'] . "</option>";
                        }
                        else {
                            echo "'>" . $val['Name'] . "</option>";
                        }
                        }
                    }

                    else {
                 foreach($muni_navitems as $val) {
                    echo "<option value='" . $val['Muni_Id'] . "'>" . $val['Name'] . "</option>";
                    }
                  }
                }
?>
                    </select></div>
                <div class="form-group">
                    <label for="zipcode">Postnummer</label>
                    <input type="text" class="form-control" id="zipcode" name="zipcode" <?php if(isset($_POST['zipcode'])) { echo "value='" . $_POST['zipcode'] . "'"; } ?> >
                </div>
                <div class="form-group">
                    <label for="city">Ort</label>
                    <input type="text" class="form-control" id="city" name="city" <?php if(isset($_POST['city'])) { echo "value='" . $_POST['city'] . "'"; } ?> >
                </div>
</div>
<div class="col-sm-4">
                <div class='form-group'><label for='cat'>Kategori</label>
                <select class='form-control' name='cat' id='cat'>
                <option value='' selected disabled>Välj kategori</option>
          
<?php
                    foreach($cat_navitems as $val) {
                        echo "<option value='" . $val['Cat_Id'] . "' "; if(isset($_POST['cat'])) { if($_POST['cat'] == $val['Cat_Id']) {echo "selected"; }}
                        echo ">" . $val['Name'] . "</option>";
                    }
?>                
                    </select></div>
                 <div class='form-group form-radio-add'><ul><li><label for='t1'><input type='radio' name='type' id='t1' value='1'> Säljes</label></li>
                 <li><label for='t2'><input type='radio' name='type' id='t2' value='2'> Köpes</label></li>
                 <li><label for='t3'><input type='radio' name='type' id='t3' value='3'> Bytes</label></li>
                 <li><label for='t4'><input type='radio' name='type' id='t4' value='4'> Uthyres</label></li>
                 <li><label for='t5'><input type='radio' name='type' id='t5' value='5'> Önskar hyra</label></li></ul></div>
                <div class="form-group">
                    <label for="title">Rubrik</label>
                    <input type="text" class="form-control" id="title" name="title" <?php if(isset($_POST['title'])) { echo "value='" . $_POST['title'] . "'"; } ?> >
                </div>
                <div class="form-group">
                <label for="text">Text</label>
                <textarea class="form-control" rows="8" id="text" name="text"><?php if(isset($_POST['text'])) { echo $_POST['text']; } ?></textarea>
                </div>
                <div class="form-group">
                    <label for="price">Pris inkl. moms</label>
                    <div class="input-group">
                    <input type="text" class="form-control" id="price" name="price" <?php if(isset($_POST['price'])) { echo "value='" . $_POST['price'] . "'"; } ?> >
                    <span class="input-group-addon">kr</span>
                        </div>
                </div>
</div>
<div class="col-sm-4">
                    <?php                         
                        if(isset($uploadmessage)) {
                            echo $uploadmessage;
                        }
                        if(isset($images)) {
                            foreach($images as $val) {
        
                            echo "<img class='img-responsive' src='" . $val . "'>";
                            }
                        }
                    ?>
                <div class="form-group">
                    <label for="password">Lösenord</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                <div class="form-group">
                    <label for="password">Upprepa lösenord</label>
                    <input type="password" class="form-control" name="password-confirm" id="password">
                </div>

                    <div class="form-group">
                    <label>Bilder</label>
                </div>        
                        <div class="form-group">
                     <input type="file" name="files[]" id="filer_input2" multiple="multiple">
                        </div>
                <div class="form-group">
                    <label for="agreements">Godkänn villkor</label></br>
                    <input type="checkbox" name="agreements" id="agreements" value="yes"> Jag godkänner användarvillkor och personuppgiftshantering
                </div>

                    <?php 
                    if(isset($message)) {
                            echo "<div class='form-group'>";
                            echo "<h4 class='danger'>" . $message . "</h4>";
                            echo "</div>";
                        }
                    ?>   

                <div class="form-group">
                    <button class="btn form-control" id="postAd" name="postAd" onclick="this.form.submit();">Lägg in annonsen</button>
                </div>

                <div class="form-group">     

                </div>
</div>  
                </form>

</div>

<?php

require($tpl_path . "banners.tpl.php");
require($tpl_path . "footer.tpl.php");
    
 }
?>