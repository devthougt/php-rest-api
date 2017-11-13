<?php
require 'db-connect.php';

function checkFields(){
    for ($i = 0; $i < func_num_args(); $i++) {
        $field = func_get_arg($i);
        if ($field === null)
            return false;
    }

    return true;
}

//get string from url
function getStringParams($value)
{
    if (isset($_GET[$value]) && !empty($_GET[$value]))
    {
        $value = trim($_GET[$value]);
        if ($value != '')
            return $value;
    }

    return null;
}

//return get request
function get_value($value){
    if($value == " ")
        return null;
    return "'". mysqli_real_escape_string($GLOBALS['connect'], $value). "'";
}

//return post request
function post_value($value){
    if($value == " ")
        return null;

    return "'". mysqli_real_escape_string($GLOBALS['connect'], $_POST[$value]);
}

//query database
function querydb($sql, $return_auto = false, $return_affected_rows = false){
    $query = mysqli_query($GLOBALS['connect'], $sql);
    if($query){
        if($return_auto){
            $auto = mysqli_insert_id($GLOBALS['connect']);
            return $auto;
        }else if($return_affected_rows){
            $affected = mysqli_affected_rows($GLOBALS['connect']);
            return $affected;
        }
        return $query;
    }else{
        $error = mysqli_error($GLOBALS['connect']);
        return $error;
    }

}

//return new id after insertion
function querydbReturnNewID($query_build)
{
    return querydb($query_build, true);
}

//retrun afftected rows after delete or updated
function querydbReturnAffectedRows($query_build)
{
    return querydb($query_build, false, true);
}

function api_response($success, $data, $error_message){
    $result = [];
    $result['success'] = $success;
    $result['data'] = $data;
    $result['error_message'] = $error_message;
    return json_encode($result);
}
