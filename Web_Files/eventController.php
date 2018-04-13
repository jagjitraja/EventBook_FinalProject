<?php

require "./ModelFiles/model.php";
require "./Event.php";

session_start();

if (!isset($_SESSION['LOGGED_IN']) || $_SESSION['LOGGED_IN'] != 'YES') {
    $_SESSION['LOGGED_IN'] = 'NO';
}

if (isset($_POST["EVENT_DATA"])) {
    $eventDataArray = $_POST["EVENT_DATA"];
} else {
    $eventDataArray = $_POST;
}

if (isset($_SESSION['USER_INFO']))
    $postersDataArray = $_SESSION['USER_INFO'];

if (isset($_GET['EventID'])) {
    $events = (selectEvent($_GET['EventID']));

    foreach ($events as $event) {
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

        $htmlEventListString = '<html>
<head>  
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="./View_Styles_And_JS/homeStyles.css"/>
    
    </head>
    
    <body>
   <div class="card container bg-light border-info mb-3 mt-5" >
                   
                    <div class="card-header"><h5>' . $eventName . '</h5><h6 class="lead" style="float: right;">' . $eventType . '</h6></div>
                    <div class="card-body" id="eventContent">
                        <h5 class="card-title" id="eventName">' .
            $postersName . '</h5>
                        <h6 class="card-subtitle mb-2 text-muted" id="eventLocation" style="display: inline-block;">' .
            $eventCity . ', ' .
            $eventState . '</h6>                           
                        <h6 class="card-subtitle mb-2 text-muted" id="eventDate" style="display:inline-block; float: right;">' .
            $eventDate . '</h6>
                        <p class="card-text text-justify" id="eventDescription">' .
            $eventDescription . '</p>
                        <div class="card-footer eventSaveRegisterButtons">
                        <button id="saveEvent" name = "saveEvent" value="' . $eventID . '" class="btn btn-primary eventButton">Save Event</button></a>
                        <button id="attendEvent" name = "attendEvent" value="' . $eventID . '"class="btn btn-warning eventButton" style="float: right">Attend Event/ Register</button>
                        <button id="removeEvent" style="display: none;" name = "removeEvent" value="' . $eventID . '" class="btn btn-danger">Remove Event</button></a>
                        </div>
                        
                   </div>
                  
     </div>

    
    </body>
    
    </html>';
    }
    echo $htmlEventListString;
    exit();
} else {

    if ($eventDataArray['PAGE'] == 'LOGGED_IN') {

        $postersID = $postersDataArray['User_ID'];
        $command = $eventDataArray['COMMAND'];

        if (isset($eventDataArray['SELECT_TYPE'])) {
            $selectType = $eventDataArray['SELECT_TYPE'];
        }

        switch ($command) {
            case 'POST_EVENT':
                $eventName = $eventDataArray['EVENTNAME'];
                $eventDescription = $eventDataArray['EVENTDESCRIPTION'];
                $eventDate = $eventDataArray['EVENTDATE'];
                $eventPrice = $eventDataArray['EVENTPRICE'];
                $eventAddress = $eventDataArray['EVENTADDRESS'];
                $eventCity = $eventDataArray['EVENTCITY'];
                $eventState = $eventDataArray['EVENTSTATE'];
                $eventType = $eventDataArray['EVENTTYPE'];

                if (addEvent($postersID, $eventName, $eventDescription, $eventDate, $eventPrice, $eventAddress
                    , $eventCity, $eventState, $eventType)) {
                    echo true;
                } else {
                    return false;
                }
                break;
            case 'GET_ALL_EVENTS':
                $a = getUpdatedEvents(-1, $selectType);
                echo $a;
                break;

            case 'GET_MY_EVENTS':
                $dbS = getUpdatedEvents($postersID, 'ALL');
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
                $result = addSavedEvent($eventID, $postersID);
                if ($result) {
                    echo "Saving Event Successful, See you there :)";
                } else {
                    echo "Saving Event Unsuccessful, we failed sorry :(";
                }
                break;
            case 'ATTEND_EVENT':
                $eventID = $_POST['EVENT_ID'];
                $result = addAttendEvent($eventID, $postersID);
                if ($result) {
                    echo "Saving Event Successful, See you there :)";
                } else {
                    echo "Saving Event Unsuccessful, we failed sorry :(";
                }
                break;

            case 'REMOVE_SAVED_EVENT':
                $eventID = $_POST['EVENT_ID'];
                $result = removeSavedEvent($postersID, $eventID);

                echo $eventID;

                break;
            case 'REMOVE_ATTENDING_EVENT':
                $eventID = $_POST['EVENT_ID'];
                $result = removeAttendingEvent($postersID, $eventID);
                echo $eventID;

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

    } elseif ($_POST['PAGE'] == 'HOME') {

        $command = $_POST['COMMAND'];
        $selectType = $_POST['SELECT_TYPE'];
        switch ($command) {
            case "GET_PUBLIC_EVENTS":
                echo getUpdatedEvents(-1, $selectType);
                break;
            case 'SEARCH':
                $searchResult = searchEvents($_POST['CRITERIA']);
                echo processEvents($searchResult);
                break;
            default:
                break;
        }

    } elseif ($_POST['PAGE'] == 'MY_PROFILE') {

        $command = $_POST['COMMAND'];
        $postersDataArray = $_SESSION['USER_INFO'];
        $userID = $postersDataArray['User_ID'];

        switch ($command) {
            case "GET_MY_EVENTS":
                echo json_encode(getAllEvents($userID, 'ALL'));
                break;
            case 'SEARCH':
                $searchResult = searchEvents($_POST['CRITERIA']);
                echo processEvents($searchResult);
                break;
            case 'UPDATE_EVENTS':
                $eventName = $eventDataArray['EVENTNAME'];
                $eventDescription = $eventDataArray['EVENTDESCRIPTION'];
                $eventDate = $eventDataArray['EVENTDATE'];
                $eventPrice = $eventDataArray['EVENTPRICE'];
                $eventAddress = $eventDataArray['EVENTADDRESS'];
                $eventCity = $eventDataArray['EVENTCITY'];
                $eventState = $eventDataArray['EVENTSTATE'];
                $eventType = $eventDataArray['EVENTTYPE'];
                $eventID = $eventDataArray['EVENT_ID'];

                if (updateEventInfo($eventID, $eventName, $eventDescription, $eventDate, $eventPrice, $eventAddress
                    , $eventCity, $eventState, $eventType)) {
                    echo getUpdatedEvents();
                } else {
                    return false;
                }
                break;
            case 'DELETE_EVENTS':
                $eventID = $_POST['EVENT_ID'];
                echo(deleteEvent($eventID));
                break;
            case 'DELETE_ACCOUNT':
                echo(deleteAccount($userID));
                include "home.php";
                exit();
                break;
            default:
                break;
        }

    } else {
        echo "An error occured";
        signOut();
        include "home.php";
    }
}


function getUpdatedEvents($uid = -1, $selectType = "ALL")
{
    $dbS = getAllEvents($uid, $selectType);
    $a = processEvents($dbS);
    return $a;
}

function processEvents($eventsFromDatabase)
{
    $htmlEventListString = "";

    if (count($eventsFromDatabase) === 0) {
        return '<div class="alert-danger"><h1 class="text-center"> No Events Found :(</h1></div>';
    }

    if (is_array($eventsFromDatabase) || is_object($eventsFromDatabase)) {
        foreach ($eventsFromDatabase as $event) {
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

            $eventObject = new Event($eventID, $postersID, $eventName, $eventDescription, $eventDate, 
			$eventPrice, $eventAddress
                , $eventCity, $eventState, $postersName, $eventType);

            $htmlEventListString .= $eventObject->getEventLayoutString();
        }
        return $htmlEventListString;
    } else {
        print_r($eventsFromDatabase);
        return $eventsFromDatabase;
    }
}

?>


