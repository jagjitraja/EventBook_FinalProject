<?php
/**
 * Created by PhpStorm.
 * User: T00533766
 * Date: 3/29/2018
 * Time: 10:25 AM
 */

class Event
{
    public $eventID;
    public $postersID;
    public $postersName;
    public $eventName;
    public $eventDescription;
    public $eventDate;
    public $eventPrice;
    public $eventCity;
    public $eventState;
    public $eventType;

    function __construct($eventID,$postersID, $eventName, $eventDescription, $eventDate, $eventPrice, $eventAddress
        , $eventCity, $eventState, $postersName,$eventType){

        $this->eventID = $eventID;
        $this->postersID = $postersID;
        $this->eventName = $eventName;
        $this->eventDescription = $eventDescription;
        $this->eventDate = $eventDate;
        $this->eventPrice = $eventPrice;
        $this->eventCity = $eventCity;
        $this->eventState = $eventState;
        $this->postersName = $postersName;
        $this->eventType = $eventType;

    }

    public function getEventLayoutString(){

        $str =  '<div class="card container bg-light border-info mb-3 eventBody" id="'.$this->eventID.'">
                    <div class = "btn-block float-right mb-2 mt-2 eventOwnerButtons" style="display:none;">
                    <button class="btn btn-info btn-sm" title="Edit Event" id="editEventButton"><i class="material-icons">mode_edit</i></button>
                    <button class="btn btn-danger btn-sm" title="Delete Event" id="deleteEventButton"><i class="material-icons">&#xE872;</i></button>
                    </div>
                    <div class="card-header"><h5>'.$this->postersName.'</h5><h6 class="lead" style="float: right;">'.$this->eventType.'</h6></div>
                    <div class="card-body" id="eventContent">
                        <h5 class="card-title" id="eventName">'.
            $this->eventName.'</h5>
                        <h6 class="card-subtitle mb-2 text-muted" id="eventLocation" style="display: inline-block;">'.
            $this->eventCity.', '.
            $this->eventState.'</h6>                           
                        <h6 class="card-subtitle mb-2 text-muted" id="eventDate" style="display:inline-block; float: right;">'.
            $this->eventDate.'</h6>
                        <p class="card-text text-justify" id="eventDescription">'.
            $this->eventDescription.'</p>
                        <div class="card-footer">
                        <button id="saveEvent" name = "saveEvent" value="'.$this->eventID.'" class="btn btn-primary eventButton">Save Event</button></a>
                        <button id="attendEvent" name = "attendEvent" value="'.$this->eventID.'"class="btn btn-warning eventButton" style="float: right">Attend Event/ Register</button>
                    </div>
                   </div>
                </div>';

        return $str;
    }
}

?>