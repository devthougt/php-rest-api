<?php


#add free_lancer with the following required parameter
function doAddFreeLancer($name, $email, $location, $phone, $categories){
    try{
        $name = get_value($name);
        $email = get_value($email);
        $location = get_value($location);
        $phone = get_value($phone);
        $categories = get_value($categories);

      $query = "SELECT email FROM free_lancer WHERE email = $email";
        $sql_querydb = querydb($query);
        if(mysqli_fetch_assoc($sql_querydb) > 1){
            return api_response(false, null, "user already exist");
        }

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