<?php
require '../model/app-function.php';
require 'functions/api-request.php';

if(isset($_GET['do'])){
    switch (strtolower($_GET['do'])) {
        case 'api':
            # code...
              try{
                $name = getStringParams('name');
                $location = getStringParams('location');
                $phone = getStringParams('phone');
                $email = getStringParams('email');
                $category = getStringParams('category');
                if(checkFields($name, $location, $phone, $email, $category)){
                    $addFreeLancer =  doApiRequest($email, $name, $location, $phone, $category);
                    echo $addFreeLancer;
                }else{
                    echo api_response(false, null, "failed");
                }


            }catch(Exception $ex){
                echo api_response(false, null, $ex->getMessage());
            }
            break;
        
        default:
            # code...
            break;
    }
}