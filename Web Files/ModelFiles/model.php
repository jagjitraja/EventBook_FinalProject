<?php
/**
 * Created by PhpStorm.
 * User: T00533766
 * Date: 3/22/2018
 * Time: 5:43 PM
 */

$db_conn = mysqli_connect('localhost','jbilkhuw7','jbilkhuw7424','COMP3540_jbilkhu');


function checkConnection(){
    global $db_conn;
    if(mysqli_connect_errno()) {
        return false;
    }
    return true;
}

function userExistsInDB($email){

    global $db_conn;

    if(checkConnection()) {
        $sql = 'SELECT * FROM EventBook_Users WHERE UPPER("$email") = UPPER(USER_EMAIL)';
        $result = mysqli_query($db_conn,$sql);

        if(mysqli_num_rows($result)>1){
            return true;
        }
    }
    return false;
}

function addUserInDB($username,$email,$password,$phone){
    global $db_conn;
    $sql = 'INSERT INTO EventBook_Users(USER_NAME, USER_EMAIL, USER_PHONE_NUMBER, USER_PASSWORD) 
            VALUES ("$username","$email","$phone","$password")';

    if(!userExistsInDB($email)){

        $result = mysqli_query($db_conn,$sql);
        return $result;
    }else{
        return false;
    }
}

function checkEmailPassword($email,$password){

    global $db_conn;
    $sql = "SELECT FROM EventBook_Users WHERE USER_EMAIL = '$email' AND USER_PASSWORD = '$password'";

    $result = mysqli_query($db_conn,$sql);

    if(mysqli_num_rows($result)>0){
        return $result;
    }else{
        return false;
    }
}


//TODO: CHANGE EMAIL, PASSWORD, PHONE AND USER NAME
//TODO: EVENTS SQL


?>