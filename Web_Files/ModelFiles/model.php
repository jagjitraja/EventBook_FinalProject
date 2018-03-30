<?php
/**
 * Created by PhpStorm.
 * User: T00533766
 * Date: 3/22/2018
 * Time: 5:43 PM
 */

$db_conn = mysqli_connect(
    'localhost',
    'jbilkhuw7',
    'jbilkhuw7424',
    'COMP3540_jbilkhu');


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
        $sql = "SELECT * FROM EventBook_Users WHERE UPPER('$email') = UPPER(USER_EMAIL);";
        $result = mysqli_query($db_conn,$sql);

        if(mysqli_num_rows($result)>1){
            return true;
        }
    }
    return false;
}

function addUserInDB($username,$email,$password,$phone,$city,$state){
    global $db_conn;
    $sql = "INSERT INTO EventBook_Users (User_ID,USER_NAME, USER_EMAIL, USER_PHONE_NUMBER, USER_PASSWORD, USER_CITY, USER_STATE) 
            VALUES (NULL,'$username','$email','$phone','$password','$city','$state');";

    if(!userExistsInDB($email)){
        $result = mysqli_query($db_conn,$sql);
        return $result;
    }else{
        return false;
    }
}

function checkEmailPassword($email,$password){

    global $db_conn;
    $sql = "SELECT * FROM EventBook_Users WHERE (USER_EMAIL = '$email' AND USER_PASSWORD = '$password');";

    $result = mysqli_query($db_conn,$sql);
    if(mysqli_num_rows($result)>0){
        return $result;
    }else{
        return false;
    }
}

function getUserData($email,$password){

    global $db_conn;
    $sql = "SELECT * FROM EventBook_Users WHERE UPPER('$email') = UPPER(USER_EMAIL) AND '$password' = USER_PASSWORD;";
    $result = mysqli_query($db_conn, $sql);

    if(mysqli_num_rows($result)==1) {
        return mysqli_fetch_assoc($result);
    }else{
        return false;
    }
}
//TODO: CHANGE EMAIL, PASSWORD, PHONE AND USER NAME
//TODO: EVENTS SQL

function addEvent($posing_user_id,$eventName,$eventDescription,$eventDate,
                  $eventPrice,$eventAddress,$eventCity,$eventState)
{

    global $db_conn;

    $eventDate = date("Y-m-d", strtotime($eventDate));
    $currentDate = date('Y-m-d');

    $sql = "INSERT INTO EventBook_Events(Event_ID, Event_Name, Event_Description, Event_Date, Event_Price,
            Event_Address, Event_Posting_Date, EventBook_Posted_By_UserID, Eevnt_State, Event_City,Public_Event)
            VALUES (NULL,'$eventName','$eventDescription','$eventDate',
            '$eventPrice','$eventAddress',
            '$currentDate','$posing_user_id',
            '$eventState','$eventCity',1)";
    $result = mysqli_query($db_conn, $sql);

    if ($result) {
        return $result;
    } else {
        return false;
    }
}

function getAllEvents($uid = -1){

    global $db_conn;

    if ($uid==-1){
        $sql = "SELECT * FROM EventBook_Events;" ;
    }
    else{
        $sql = "SELECT * FROM EventBook_Events WHERE  EventBook_Posted_By_UserID = '$uid';" ;
    }

    $result = mysqli_query($db_conn,$sql);

    $eventArray = array();
    $i = 0;
    while ($row = mysqli_fetch_assoc($result)){
        $eventArray[$i] = $row;
        $i++;
    }
    return $eventArray;
}

function getPublicEvents(){

    global $db_conn;
    $sql = "SELECT * FROM EventBook_Events WHERE Public_Event = '1';" ;
    $result = mysqli_query($db_conn,$sql);

    $eventArray = array();
    $i = 0;
    while ($row = mysqli_fetch_assoc($result)){
        $eventArray[$i] = $row;
        $i++;
    }
    return $eventArray;

}


?>