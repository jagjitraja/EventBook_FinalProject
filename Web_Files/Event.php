<?php
/**
 * Created by PhpStorm.
 * User: T00533766
 * Date: 3/29/2018
 * Time: 10:25 AM
 */

class Event
{
    public $postersID;
    public $eventName;
    public $eventDescription;
    public $eventDate;
    public $eventPrice;
    public $eventCity;
    public $eventState;

    function __construct($postersID, $eventName, $eventDescription, $eventDate, $eventPrice, $eventAddress
        , $eventCity, $eventState){

        $this->postersID = $postersID;
        $this->eventName = $eventName;
        $this->eventDescription = $eventDescription;
        $this->eventDate = $eventDate;
        $this->eventPrice = $eventPrice;
        $this->eventCity = $eventCity;
        $this->eventState = $eventState;

    }

    public function getEventLayoutString(){

        $str =  '<div class="card container bg-light" id="eventBody">.
                    <div class="card-body" id="eventContent">.
                        <h5 class="card-title" id="eventName">'.
            $this->eventName.
            '</h5>.
                        <h6 class="card-subtitle mb-2 text-muted" id="eventLocation" style="display: inline-block;">'.
            $this->eventCity.', '.
            $this->eventState.'
                           </h6>.
                           
                        <h6 class="card-subtitle mb-2 text-muted" id="eventDate" style="display:inline-block; float: right;">'.
            $this->eventDate.'</h6>.
                        <p class="card-text" id="eventDescription">'.
            $this->eventDescription.'</p>.
                        <button class="btn btn-primary">Save Event</button></a>.
                        <button class="btn btn-warning" style="float: right">Attend Event/ Register</button>.
                   </div>.
                </div>';

        return $str;
    }
}

?>