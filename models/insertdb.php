<?php

function doInsertFile($email, $category){
    $target_dir = "uploads/";
    $target_file = $target_dir.basename($_FILES["image"]["name"]);
    $uploadOk = true;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    #$img = "fileselect";

    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if(!$check) {
        echo api_response(false, null, "File is not an image.");
        $uploadOk = false;
    }

    #check if file exist in directory
    if (file_exists($target_file)) {
        echo api_response(false, null, "file already exist");
        $uploadOk = false;
    }

    #check file size
    if ($_FILES["image"]["size"] > 1500000) {
        echo api_response(false, null, "file too large");
        $uploadOk = false;
    }

    #check for the file format if image format?
    #allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "JPG" && $imageFileType != "png" && $imageFileType != "PNG"
        && $imageFileType != "jpeg" && $imageFileType != "JPEG")
    {
        echo api_response(false, null, "not an image file");
        $uploadOk = false;
    }

    #check if uploadok is true
    if ($uploadOk) {
        $imageData = mysql_real_escape_string(file_get_contents($_FILES["image"]["tmp_name"]));
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {

            try{
                $email = get_value('email');
                $category = get_value('category');
                $file = $target_file;

                $query = "INSERT INTO free_lancer_upload (email, category, upload) VALUES ($email, $category, $file)";
                $auto = querydbReturnNewID($query);

                $free_lancer['free_lancer_upload'] = $auto;
                echo api_response(true, null, "file". basename( $_FILES["image"]["name"])."has been upoloaded");
                return api_response(true, null, 'done');

            }catch(Exception $ex){
                return api_response(false, null, $ex->getMessage());
            }

        }

        else{
            echo api_response(false, null, "file cannot be uploaded");
        }

    }
}