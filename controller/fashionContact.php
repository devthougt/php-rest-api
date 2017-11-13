<?php

require '../models/db-connect.php';
require '../models/query.php';
require '../models/insertdb.php';

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
                $category = getStringParams('cate');
                if(checkFields($email, $category)){
                    $fileUpload = doInsertFile($email, $category);
                    echo $fileUpload;
                }else{
                    echo api_response(false, null, "failed");
                }
            }catch(Exception $ex){
                echo api_response(false, null, "failed");
            }
    }
}


#add free_lancer with the following required parameter
function doAddFreeLancer($name, $email, $location, $phone, $categories){
    try{
        $name = get_value($name);
        $email = get_value($email);
        $location = get_value($location);
        $phone = get_value($phone);
        $categories = get_value($categories);

        $query = "INSERT INTO free_lancer (name, email, location, category, phone) VALUES ($name, $email, $location, $categories, $phone)";
        $auto = querydbReturnNewID($query);

        $free_lancer['free_lancer'] = $auto;
        return api_response(true, null, 'done');

    }catch(Exception $ex){
        return api_response(false, null, $ex->getMessage());
    }
}



#function to find free_lancer by location
#location variable as the location 
function doFindFreeLancerByLocation($location){
    try{
        $location = get_value($location);

        //sql query to find free_lancer by location
        $query = "SELECT * FROM free_lancer WHERE location = $location";
        $sql_querydb = querydb($query);
        while($query_row_location = mysqli_fetch_assoc($sql_querydb)){
            $result[] = $query_row_location;
        }
        return api_response(true, $result, 'done');

    }catch(Exception $ex){
        return api_response(false, null, 'failed');
    }
}


#function to find free_laancer by category
#category variable as the category [male_clothings, female_clothings, both];
function doFindFreeLancerByCategory($categories){
    try{
        $categories = get_value($categories);

        //sql query to find free_lancer by category
        $query = "SELECT * FROM free_lancer WHERE category = $categories";
        $sql_querydb = querydb($query);
        while($query_row_categories = mysqli_fetch_assoc($sql_querydb)){
            $result[] = $query_row_categories;
        }
        return api_response(true, $result, 'done');

    }catch(Exception $ex){
        return api_response(false, null, 'failed');
    }
}