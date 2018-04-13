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


function checkConnection()
{
    global $db_conn;
    if (mysqli_connect_errno()) {
        return false;
    }
    return true;
}

function userExistsInDB($email)
{

    global $db_conn;

    if (checkConnection()) {
        $sql = "SELECT * FROM EventBook_Users WHERE UPPER('$email') = UPPER(USER_EMAIL);";
        $result = mysqli_query($db_conn, $sql);

        if (mysqli_num_rows($result) > 1) {
            return true;
        }
    }
    return false;
}

function getEventPostersName($userID){
    global $db_conn;
    $sql = "SELECT USER_NAME FROM EventBook_Users WHERE (User_ID = '$userID');";

    $result = mysqli_query($db_conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    } else {
        return false;
    }
}

function addUserInDB($username, $email, $password, $phone, $city, $state)
{
    global $db_conn;
    $sql = "INSERT INTO EventBook_Users (User_ID,USER_NAME, USER_EMAIL, USER_PHONE_NUMBER, USER_PASSWORD, USER_CITY, USER_STATE) 
            VALUES (NULL,'$username','$email','$phone','$password','$city','$state');";

    if (!userExistsInDB($email)) {
        $result = mysqli_query($db_conn, $sql);
        return $result;
    } else {
        return false;
    }
}

function checkEmailPassword($email, $password)
{

    global $db_conn;
    $sql = "SELECT * FROM EventBook_Users WHERE (USER_EMAIL = '$email' AND USER_PASSWORD = '$password');";

    $result = mysqli_query($db_conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        return $result;
    } else {
        return false;
    }
}

function getUserData($email, $password)
{

    global $db_conn;
    $sql = "SELECT * FROM EventBook_Users WHERE UPPER('$email') = UPPER(USER_EMAIL) AND '$password' = USER_PASSWORD;";
    $result = mysqli_query($db_conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        return mysqli_fetch_assoc($result);
    } else {
        return false;
    }
}
function addEvent($posing_user_id, $eventName, $eventDescription, $eventDate,
                  $eventPrice, $eventAddress, $eventCity, $eventState, $eventType){
    global $db_conn;

    $eventDate = date("Y-m-d", strtotime($eventDate));
    $currentDate = date('Y-m-d');

    $sql = "INSERT INTO EventBook_Events(Event_ID, Event_Name, Event_Description, Event_Date, Event_Price,
            Event_Address, Event_Posting_Date, EventBook_Posted_By_UserID, Eevnt_State, Event_City, Event_Type)
            VALUES (NULL,'$eventName','$eventDescription','$eventDate',
            '$eventPrice','$eventAddress',
            '$currentDate','$posing_user_id',
            '$eventState','$eventCity','$eventType')";
    $result = mysqli_query($db_conn, $sql);

    if ($result) {
        return $result;
    } else {
        return false;
    }
}

function getAllEvents($uid = -1,$selectType = "ALL"){

    $sql = "SELECT * FROM EventBook_Events ";

    global $db_conn;
    if ($uid!== -1){
        $sql .= "WHERE EventBook_Posted_By_UserID = '$uid'";
    }

    if ($selectType!="ALL"){
        $sql .=" WHERE UPPER (Event_Type) = UPPER ('$selectType') ORDER BY Event_Posting_Date DESC;";
    }else{
        $sql .=" ORDER BY Event_Posting_Date DESC;";
    }

    $result = mysqli_query($db_conn, $sql);
    $eventArray = array();
    $i = 0;

    while ($row = mysqli_fetch_assoc($result)) {
        $eventArray[$i] = $row;
        $i++;
    }
    return $eventArray;
}

function getSavedEvents($userID,$selectType = "ALL")
{
    $sql = "SELECT * FROM EventBook_Events ";
    global $db_conn;
    if ($userID!== -1){
        $sql .= "WHERE Event_ID IN (SELECT Interested_Event_ID FROM EventBook_Interested_Users
                 WHERE '$userID' = Interested_User_ID)";
    }
    $sql .=" ORDER BY Event_Posting_Date DESC;";


    $result = mysqli_query($db_conn, $sql);

    $eventArray = array();
    $i = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $eventArray[$i] = $row;
        $i++;
    }
    return $eventArray;
}

function getRegisteredEvents($userID,$selectType = "ALL")
{
    $sql = "SELECT * FROM EventBook_Events ";
    global $db_conn;
    if ($userID!== -1){
        $sql .= "WHERE Event_ID IN (SELECT Attending_Event_ID FROM EventBook_Attending_Users
                 WHERE '$userID' = Attending_User_ID)";
    }

    $sql .=" ORDER BY Event_Posting_Date DESC;";

    $result = mysqli_query($db_conn, $sql);

    $eventArray = array();
    $i = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $eventArray[$i] = $row;
        $i++;
    }
    return $eventArray;
}


function addSavedEvent($eventID, $postersID)
{
    global $db_conn;
    $currentDate = date('Y-m-d');
    $sql = "INSERT INTO EventBook_Interested_Users(Interested_User_ID, 
                                                    Interested_Event_ID, Date_User_Set_Interested)
                                                     
          VALUES ('$postersID','$eventID','$currentDate')";

    $result = mysqli_query($db_conn, $sql);

    if ($result) {
        return $result;
    } else {
        return false;
    }
}

function addAttendEvent($eventID, $postersID)
{
    global $db_conn;

    $currentDate = date('Y-m-d');
    $sql = "INSERT INTO EventBook_Attending_Users(Attending_User_ID, 
                                                    Attending_Event_ID, Date_Registered)
                                                     
          VALUES ('$postersID','$eventID','$currentDate')";

    $result = mysqli_query($db_conn, $sql);

    if ($result) {
        return $result;
    } else {
        return false;
    }
}

function updateUserInfo($user_id,$username, $phoneNumber, $emailEntered, $passwordEntered, $userState, $userCity)
{
    global $db_conn;

    $sql = "UPDATE EventBook_Users SET USER_NAME='$username',
        USER_EMAIL='$emailEntered',USER_PHONE_NUMBER='$phoneNumber',
        USER_PASSWORD='$passwordEntered',USER_CITY='$userCity',USER_STATE='$userState' 
        WHERE User_ID = '$user_id'";

    $result = mysqli_query($db_conn, $sql);

    if ($result) {
        return $result;
    } else {
        return false;
    }
}

function searchEvents($criteria){

    global $db_conn;
    if ($criteria == -1) {
        $sql = "SELECT * FROM EventBook_Events ORDER BY Event_Posting_Date DESC;";
    } else {
        $sql = "SELECT * FROM EventBook_Events WHERE Event_Name LIKE '%$criteria%' 
                OR Event_Description LIKE '%$criteria%' 
                ORDER BY Event_Posting_Date DESC;";
    }
    $result = mysqli_query($db_conn, $sql);
    $eventArray = array();
    $i = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $eventArray[$i] = $row;
        $i++;
    }
    return $eventArray;
}

function updateEventInfo($eventID,$eventName,$eventDescription,$eventDate,$eventPrice,
                         $eventAddress,$eventCity,$eventState,$eventType){

    global $db_conn;
    $currentDate = date('Y-m-d');
    $sql = "UPDATE EventBook_Events SET 
            Event_Name='$eventName',Event_Description='$eventDescription',
            Event_Date='$eventDate',Event_Price='$eventPrice',
            Event_Address='$eventAddress',Event_Posting_Date='$currentDate',
            Eevnt_State='$eventState',
            Event_City='$eventCity',Event_Type='$eventType' WHERE Event_ID = '$eventID';";

    $result = mysqli_query($db_conn,$sql);
    return $result;
}

function deleteEvent($eventID){
    global $db_conn;

    $sql = "DELETE FROM EventBook_Interested_Users WHERE Interested_Event_ID = $eventID;";
    $result = mysqli_query($db_conn,$sql);

    $sql = "DELETE FROM EventBook_Attending_Users WHERE Attending_Event_ID = $eventID;";
    $result = mysqli_query($db_conn,$sql);

    $sql = "DELETE FROM EventBook_Events WHERE Event_ID = $eventID;";
    $result = mysqli_query($db_conn,$sql);

    return $result;
}

function deleteAccount($userID){
    global $db_conn;

    $sql = "DELETE FROM EventBook_Interested_Users WHERE Interested_User_ID = $userID;";
    $result = mysqli_query($db_conn,$sql);

    $sql = "DELETE FROM EventBook_Attending_Users WHERE Attending_User_ID = $userID;";
    $result = mysqli_query($db_conn,$sql);

    $sql = "DELETE FROM EventBook_Events WHERE EventBook_Posted_By_UserID = $userID;";
    $result = mysqli_query($db_conn,$sql);

    $sql = "DELETE FROM EventBook_Users WHERE User_ID = $userID;";
    $result = mysqli_query($db_conn,$sql);

    return $result;
}

function removeSavedEvent($userID,$eventID){
    global $db_conn;

    $sql = "DELETE FROM EventBook_Interested_Users WHERE 
Interested_User_ID = '$userID' AND Interested_Event_ID = '$eventID';";

    print_r($sql);
    $result = mysqli_query($db_conn,$sql);

    return $sql;
}
function removeAttendingEvent($userID,$eventID){
    global $db_conn;

    $sql = "DELETE FROM EventBook_Attending_Users WHERE 
Attending_User_ID = '$userID' AND Attending_Event_ID = '$eventID';";

    print_r($sql);
    $result = mysqli_query($db_conn,$sql);

    return $sql;
}


function selectEvent($eventID){
    global $db_conn;

    $sql = "SELECT * FROM EventBook_Events WHERE Event_ID = '$eventID'
            ORDER BY Event_Posting_Date DESC;";

    $result = mysqli_query($db_conn, $sql);
    $eventArray = array();
    $i = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $eventArray[$i] = $row;
        $i++;
    }
    return $eventArray;
}

?>