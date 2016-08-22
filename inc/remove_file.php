<?php 
require('path.php');
    include($class_path . 'class.db.php');
    include($class_path . 'class.uploader.php');  
    include($class_path . 'ad/class.addad.php');

session_start();
$addad = new AddAd();

if(isset($_POST['file'])){
    $file = '../' . $img_content_path . 'uploads/' . $_POST['file'];
    if(file_exists($file)){
        unlink($file);
        $addad->deleteImages($_POST['file']);
    }
}
?>