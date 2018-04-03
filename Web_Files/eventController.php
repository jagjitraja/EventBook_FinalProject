
<?php

require "./ModelFiles/model.php";
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

    if (isset($eventDataArray['SELECT_TYPE'])) {
        $selectType = $eventDataArray['SELECT_TYPE'];
    }

    switch ($command){
        case 'POST_EVENT':

            $eventName = $eventDataArray['EVENTNAME'];
            $eventDescription = $eventDataArray['EVENTDESCRIPTION'];
            $eventDate = $eventDataArray['EVENTDATE'];
            $eventPrice = $eventDataArray['EVENTPRICE'];
            $eventAddress = $eventDataArray['EVENTADDRESS'];
            $eventCity = $eventDataArray['EVENTCITY'];
            $eventState = $eventDataArray['EVENTSTATE'];
            $eventType = $eventDataArray['EVENTTYPE'];

            if(addEvent($postersID,$eventName,$eventDescription,$eventDate,$eventPrice,$eventAddress
                    ,$eventCity,$eventState,$eventType)){

                echo getUpdatedEvents();
            }else{
                return false;
            }
            break;
        case 'GET_ALL_EVENTS':
            $a = getUpdatedEvents(-1,$selectType);
            echo $a;
            break;

        case 'GET_MY_EVENTS':
            $dbS = getUpdatedEvents($postersID,'ALL');
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
            $result = addSavedEvent($eventID,$postersID);
            if ($result){
                echo "Saving Event Successful, See you there :)";
            }else{
                echo "Saving Event Unsuccessful, we failed sorry :(";
            }
            break;
        case 'ATTEND_EVENT':
            $eventID = $_POST['EVENT_ID'];
            $result = addAttendEvent($eventID,$postersID);
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
    $selectType = $_POST['SELECT_TYPE'];
    switch ($command){
        case "GET_PUBLIC_EVENTS":
            echo getUpdatedEvents(-1,$selectType);
            break;
        case 'SEARCH':
            $searchResult = searchEvents($_POST['CRITERIA']);
            echo processEvents($searchResult);
            break;
        default:
            break;
    }

}elseif ($_POST['PAGE'] == 'MY_PROFILE'){

    $command = $_POST['COMMAND'];
    $userID = $_POST['USER_ID'];

    switch ($command){
        case "GET_MY_EVENTS":
            echo getUpdatedEvents($userID);
            break;
        case 'SEARCH':
            $searchResult = searchEvents($_POST['CRITERIA']);
            echo processEvents($searchResult);
            break;
        default:
            break;
    }

}

else{
    echo "An error occured";
    signOut();
    include "home.php";
}

function getUpdatedEvents($uid = -1,$selectType = "ALL"){
    $dbS = getAllEvents($uid,$selectType);
    $a = processEvents($dbS);
    return $a;
}

function processEvents($eventsFromDatabase){
    $htmlEventListString = "";

    if (count($eventsFromDatabase)===0){
        return '<div class="alert-danger"><h1 class="text-center"> No Events Found :(</h1></div>';
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
        $eventType = $event['Event_Type'];

        $eventObject = new Event($eventID,$postersID,$eventName,$eventDescription,$eventDate,$eventPrice,$eventAddress
            ,$eventCity,$eventState,$postersName,$eventType);

        $htmlEventListString.=$eventObject->getEventLayoutString();
    }
    return $htmlEventListString;
}

?>


