<?php
#doApiRequest fetch data from online api...
function doApiRequest($email, $name, $location, $phone, $category){
    try{
        #!important!
        $eamil = get_value($email);
        #get api data from hosted server
        $request = file_get_contents("http://34.212.19.150:8000/request/users");
        #parse api data to json_decoder 
        $json_response = json_decode($request);
        #create array to hold api data 
        $response_array = array();
        #split fetched data from api for array
        foreach ($json_response->data as $response ) {
            #add email addresses to response_array 
           array_push($response_array, $response->email);
        }
        #check if value exist in fetched api array
        if(in_array($email, $response_array)){
            #add free_lancer to database
            $addFreeLancer = doAddFreeLancer($name, $email, $location, $phone, $category);
            #fetch inserted data from parameters 
            $insertedData = array('email' => $email ,'name' => $name,'location' => $location,'phone' => $phone,
                                    'category' => $category);
            #send reponses                            
            $final = api_response(true, $insertedData, $addFreeLancer);
        }
        #returned data to user
       return $final;
        
    }catch(Exception $ex){
        return $ex->getMessage();
    }
}