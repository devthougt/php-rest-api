<?php

require('doFreeLancer.php');
function doApiRequest($email, $name, $location, $phone, $category){
    try{
        $eamil = get_value($email);
        $request = file_get_contents("http://34.212.19.150:8000/request/users");
        $json_response = json_decode($request);
        $response_array = array();
        foreach ($json_response->data as $response ) {
            # code...
           array_push($response_array, $response->email);
        }
        if(in_array($email, $response_array)){
            $successDone = doAddFreeLancer($name, $email, $location, $phone, $category);
            $final = api_response(true, $successDone, "found");
        }
       return $final;
        
    }catch(Exception $ex){
        return $ex->getMessage();
    }
}