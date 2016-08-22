<?php
    require('path.php');
    include($class_path . 'class.db.php');
    include($class_path . 'class.uploader.php');  
    include($class_path . 'ad/class.addad.php');

    $uploader = new Uploader();
    $data = $uploader->upload($_FILES['files'], array(
        'limit' => 10, //Maximum Limit of files. {null, Number}
        'maxSize' => 4, //Maximum Size of files {null, Number(in MB's)}
        'extensions' => null, //Whitelist for file extension. {null, Array(ex: array('jpg', 'png'))}
        'required' => false, //Minimum one file is required for upload {Boolean}
        'uploadDir' => '../' . $img_content_path . 'uploads/', //Upload directory {String}
        'title' => array('auto'), //New file name {null, String, Array} *please read documentation in README.md
        'removeFiles' => true, //Enable file exclusion {Boolean(extra for jQuery.filer), String($_POST field name containing json data with file names)}
        'perms' => null, //Uploaded file permisions {null, Number}
        'onCheck' => null, //A callback function name to be called by checking a file for errors (must return an array) | ($file) | Callback
        'onError' => null, //A callback function name to be called if an error occured (must return an array) | ($errors, $file) | Callback
        'onSuccess' => null, //A callback function name to be called if all files were successfully uploaded | ($files, $metas) | Callback
        'onUpload' => null, //A callback function name to be called if all files were successfully uploaded (must return an array) | ($file) | Callback
        'onComplete' => null, //A callback function name to be called when upload is complete | ($file) | Callback
        'onRemove' => 'onFilesRemoveCallback' //A callback function name to be called by removing files (must return an array) | ($removed_files) | Callback
    ));
    
        if($data['isComplete']){
        $files = $data['data']['metas'][0]['name'];
        
            session_start();
            $addad = new AddAd();
       
        if($addad->checkAdSession()) {
            $addad->addImages($files);
        }else{
            header("Location: ?page=add");
        }
        
        echo json_encode($files);
        exit;
    }

    if($data['hasErrors']){
        $errors = $data['errors'];
        print_r($errors);
    }
    

    

?>
