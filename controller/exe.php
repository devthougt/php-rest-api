<?php
require '../model/app-function.php';
require 'functions/api-request.php';
require 'functions/doFreeLancer.php';

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
                    echo api_response(false, null, "missing parameters");
                }


            }catch(Exception $ex){
                echo api_response(false, null, $ex->getMessage());
            }
            break;
    
            #find free_lancer by location 
        case 'sl' :
            try {
                $location = getStringParams('loc');
                if(checkFields($location)){
                    $searchLocation = doFindFreeLancerByLocation($location);
                    echo $searchLocation;
                }else{
                    echo api_response(false, null, "failed");

                }
            }catch(Exception $ex){
                echo api_response(false, null, $ex->getMessage());
            }
            break;

        #search for free_lancer by category [men, women, both]
        case 'sc' :
            try{
                $category = getStringParams('cate');
                if(checkFields($category)){
                    $searchCategory = doFindFreeLancerByCategory($category);
                    echo $searchCategory;
                }else{
                    echo api_response(false, null, "failed");
                }
            }catch(Exception $ex){
                echo api_response(false, null, "failed");
            }
            break;
        
        default:
            # code...
            echo api_response(false, null, "route does not exist, call to undefined request");
            break;
    }
}