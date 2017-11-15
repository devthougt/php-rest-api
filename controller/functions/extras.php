<?php
if(isset($_GET['do'])){
    switch(strtolower($_GET['do'])){
        #Add a new free lancer
        case 'add' :
            try{
                $name = getStringParams('name');
                $location = getStringParams('location');
                $phone = getStringParams('phone');
                $email = getStringParams('email');
                $category = getStringParams('category');
                if(checkFields($name, $location, $phone, $email, $category)){

                    $addFree = doAddFreeLancer($name, $email, $location, $phone, $category);
                    echo $addFree;
                }else{
                    echo api_response(false, null, "failed");
                }


            }catch(Exception $ex){
                echo api_response(false, null, $ex->getMessage());
            }
            break;

        #find free_lancer by location 
        case 'srch_loc' :
            try {
                $location = getStringParams('location');
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
        case 'srch_cate' :
            try{
                $category = getStringParams('category');
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

        case 'upload' : 
            try{
                $email = getStringParams('email');
                $category = getStringParams('category');
                $imageFile = getParams('image');
                $fileUpload = doInsertFile($imageFile);
                echo $fileUpload;
                /* if(checkFields($imageFile)){
                }else{
                    echo api_response(false, null, "failed");
                } */
            }catch(Exception $ex){
                echo api_response(false, null, "something went wrong");
            }
    }
}

