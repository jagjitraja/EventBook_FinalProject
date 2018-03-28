
<?php

include "./ModelFiles/model.php";
session_start();
var_dump($_POST);
var_dump($_SESSION);

if (!isset($_SESSION['LOGGED_IN']) || $_SESSION['LOGGED_IN'] != 'YES') {
    echo 'Session is broken<br>';
    session_unset();
    session_destroy();
    exit();
}

if ($_POST['PAGE']=='LOGGED_IN'){

    $command = $_POST['COMMAND'];
    switch ($command){
        case 'POST_EVENT':

            $eventName = $_POST['EVENTNAME'];
            $eventDescription = $_POST['EVENTDESCRIPTION'];
            $eventDate = $_POST['EVENTDATE'];
            $eventPrice = $_POST['EVENTPRICE'];
            $eventAddress = $_POST['EVENTADDRESS'];
            $eventCity = $_POST['EVENTCITY'];
            $eventState = $_POST['EVENTSTATE'];
            $postersID = $_SESSION['User_ID'];

            if(addEvent($postersID,$eventName,$eventDescription,$eventDate,$eventPrice,$eventAddress
                    ,$eventCity,$eventState)){

            }else{
                return false;
            }
            break;
        default:
            echo "AN ERROR OCCURED";
            break;
    }

}else{
    echo "An error occured";
    signOut();
    include "home.php";
}

?>


