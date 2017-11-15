<?php
require '../../model/db-connect.php';
require '../../model/app-function.php';
if(isset($_POST['upload'])) {

    $email = mysqli_escape_string($GLOBALS['connect'], $_POST['email']);
    $category = mysqli_escape_string($GLOBALS['connect'], $_POST['category']);
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);


    //check if image is 
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if (!$check) {
        echo "File is not an image";
        $uploadOk = 0;
    }


    if (file_exists($target_file)) {
        echo "file already exist";
        $uploadOk = 0;
    }


    // Check file size
    if ($_FILES["image"]["size"] > 1500000) {
        echo "image too large";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "JPG" && $imageFileType != "png" && $imageFileType != "PNG"
        && $imageFileType != "jpeg" && $imageFileType != "JPEG") {
            echo "image must be in JPEG, PNG";
            $uploadOk = 0;
    }


    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk  == 0) {
      echo "failed to upload file";
      
    }
    else {
        $imageData = mysqli_real_escape_string($GLOBALS['connect'], file_get_contents($_FILES["image"]["tmp_name"]));
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {

            $uploads = $target_file;
            $query = "INSERT INTO free_lancer_upload (email, upload, category) VALUES ('$email', '$uploads', '$category')";
            $auto = querydbReturnNewID($query);

            $free_lancer['free_lancer'] = $auto;
            echo  api_response(true, $free_lancer, null);
        }
    }
}
