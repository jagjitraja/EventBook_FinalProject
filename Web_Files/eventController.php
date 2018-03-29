
<?php

include "./ModelFiles/model.php";
require "./Event.php";

session_start();

if (!isset($_SESSION['LOGGED_IN']) || $_SESSION['LOGGED_IN'] != 'YES') {
    echo 'Session is broken<br>';
    session_unset();
    session_destroy();
    exit();
}

$eventDataArray = $_POST["EVENT_DATA"];
$postersDataArray = $_SESSION['USER_INFO'];

if ($eventDataArray['PAGE']=='LOGGED_IN'){

    $command = $eventDataArray['COMMAND'];
    switch ($command){
        case 'POST_EVENT':

            $eventName = $eventDataArray['EVENTNAME'];
            $eventDescription = $eventDataArray['EVENTDESCRIPTION'];
            $eventDate = $eventDataArray['EVENTDATE'];
            $eventPrice = $eventDataArray['EVENTPRICE'];
            $eventAddress = $eventDataArray['EVENTADDRESS'];
            $eventCity = $eventDataArray['EVENTCITY'];
            $eventState = $eventDataArray['EVENTSTATE'];

            $postersID = $postersDataArray['User_ID'];

            if(addEvent($postersID,$eventName,$eventDescription,$eventDate,$eventPrice,$eventAddress
                    ,$eventCity,$eventState)){

                $postedEvent = new Event($postersID,$eventName,$eventDescription,$eventDate,$eventPrice,$eventAddress
                    ,$eventCity,$eventState);

                echo $postedEvent->getEventLayoutString();
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


