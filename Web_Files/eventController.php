
<?php

include "./ModelFiles/model.php";
require "./Event.php";

session_start();

if (!isset($_SESSION['LOGGED_IN']) || $_SESSION['LOGGED_IN'] != 'YES') {
    $_SESSION['LOGGED_IN'] = 'NO';
}

if (isset($_POST["EVENT_DATA"])){
    $eventDataArray = $_POST["EVENT_DATA"];
}else{
    $eventDataArray = $_POST;
}

if (isset( $_SESSION['USER_INFO']))
    $postersDataArray = $_SESSION['USER_INFO'];

if ($eventDataArray['PAGE']=='LOGGED_IN'){

    $postersID = $postersDataArray['User_ID'];
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

            if(addEvent($postersID,$eventName,$eventDescription,$eventDate,$eventPrice,$eventAddress
                    ,$eventCity,$eventState)){

                echo getUpdatedEvents();
            }else{
                return false;
            }
            break;
        case 'GET_ALL_EVENTS':
            $a = getUpdatedEvents();
            echo $a;
            break;

        case 'GET_MY_EVENTS':
            $dbS = getAllEvents($postersID);
            $a = processEvents($dbS);
            echo $a;
            break;
        case 'REGISTERED_EVENTS':
            $dbS = getRegisteredEvents($postersID);
            $a = processEvents($dbS);
            echo $a;
            break;


        case 'SAVE_EVENT':
            $eventID = $_POST['EVENT_ID'];
            $result = updateSavedEvent($eventID,$postersID);
            if ($result){
                echo "Saving Event Successful, See you there :)";
            }else{
                echo "Saving Event Unsuccessful, we failed sorry :(";
            }
            break;
        case 'ATTEND_EVENT':
            $eventID = $_POST['EVENT_ID'];
            $result = updateAttendEvent($eventID,$postersID);
            if ($result){
                echo "Saving Event Successful, See you there :)";
            }else{
                echo "Saving Event Unsuccessful, we failed sorry :(";
            }
            break;

        case 'GET_MY_SAVED_EVENTS':
            $result = getSavedEvents($postersID);
            echo processEvents($result);
            break;
        case 'SEARCH':
            $searchResult = searchEvents($_POST['CRITERIA']);
            echo processEvents($searchResult);
            break;

        default:
            echo "AN ERROR OCCURED";
            break;
    }

}elseif ($_POST['PAGE'] == 'HOME'){

    $command = $_POST['COMMAND'];
    switch ($command){
        case "GET_PUBLIC_EVENTS":
            echo getUpdatedEvents();
            break;
        case 'SEARCH':
            $searchResult = searchEvents($_POST['CRITERIA']);
            echo processEvents($searchResult);
            break;
        default:
            break;
    }

} else{
    echo "An error occured";
    signOut();
    include "home.php";
}

function getUpdatedEvents(){
    $dbS = getAllEvents(-1);
    $a = processEvents($dbS);
    return $a;
}

function processEvents($eventsFromDatabase){
    $htmlEventListString = "";

    if (count($eventsFromDatabase)===0){
        return '<div class="alert-danger"><h1 class="text-center"> No Events Posted :(</h1></div>';
    }

    foreach ($eventsFromDatabase as $event){
        $eventID = $event['Event_ID'];
        $eventName = $event['Event_Name'];
        $eventDescription = $event['Event_Description'];
        $eventDate = $event['Event_Date'];
        $eventPrice = $event['Event_Price'];
        $eventAddress = $event['Event_Address'];
        $eventCity = $event['Event_City'];
        $eventState = $event['Eevnt_State'];
        $postersID = $event['EventBook_Posted_By_UserID'];
        $postersName = getEventPostersName($postersID)['USER_NAME'];

        $eventObject = new Event($eventID,$postersID,$eventName,$eventDescription,$eventDate,$eventPrice,$eventAddress
            ,$eventCity,$eventState,$postersName);

        $htmlEventListString.=$eventObject->getEventLayoutString();
    }
    return $htmlEventListString;
}

?>


