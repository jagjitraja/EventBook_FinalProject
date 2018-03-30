
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

if (isset($_POST["EVENT_DATA"])){
    $eventDataArray = $_POST["EVENT_DATA"];
}else{
    $eventDataArray = $_POST;
}

if (isset( $_SESSION['USER_INFO']))
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

                //send html formatted String
                echo $postedEvent->getEventLayoutString();
            }else{
                return false;
            }
            break;
        case 'GET_ALL_EVENTS':
            $dbS = getAllEvents();
            $a = processEvents($dbS);
            echo $a;
            break;

        case 'GET_MY_EVENTS':
            $postersID = $postersDataArray['User_ID'];

            $dbS = getAllEvents($postersID);
            $a = processEvents($dbS);
            echo $a;
            break;
        default:
            echo "AN ERROR OCCURED";
            break;
    }

}elseif ($_POST['PAGE'] == 'HOME'){

    $command = $_POST['COMMAND'];
    switch ($command){
        case "GET_PUBLIC_EVENTS":

            $dbS = getPublicEvents();
            $a = processEvents($dbS);
            echo $a;
            break;
        default:
            break;
    }

} else{
    echo "An error occured";
    signOut();
    include "home.php";
}


function processEvents($eventsFromDatabase){

    $htmlEventListString = "";

    if (count($eventsFromDatabase)===0){
        return '<div class="alert-danger"><h1 class="text-center"> No Events Posted :(</h1></div>';
    }

    foreach ($eventsFromDatabase as $event){

        $eventName = $event['Event_Name'];
        $eventDescription = $event['Event_Description'];
        $eventDate = $event['Event_Date'];
        $eventPrice = $event['Event_Price'];
        $eventAddress = $event['Event_Address'];
        $eventCity = $event['Event_City'];
        $eventState = $event['Eevnt_State'];
        $postersID = $event['EventBook_Posted_By_UserID'];

        $eventObject = new Event($postersID,$eventName,$eventDescription,$eventDate,$eventPrice,$eventAddress
            ,$eventCity,$eventState);

        $htmlEventListString.=$eventObject->getEventLayoutString();
    }
    return $htmlEventListString;
}

?>


