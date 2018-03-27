<!DOCTYPE html>
<html>
<head>
</head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="./View_Styles_And_JS/homeStyles.css"/>
<script src="./View_Styles_And_JS/homeFunctions.js" type="application/javascript"></script>

<body>


<nav id="navBar" class="navbar navbar-expand-md navbar-light bg-success fixed-top" style="margin:0">
    <a class="navbar-brand" href="home.php">EventBook</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#myNavBar">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="myNavBar">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" id="postedEvents" onclick="showModal(this.id)">Posted Events</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="savedEvents" onclick="showModal(this.id)">Saved Events</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="myProfile" onclick="showModal(this.id)">My Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="myProfile" onclick="showModal(this.id)">Logout</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="text" placeholder="Search Events"/>
            <button class="btn btn-dark my-2 my-sm-0"><span class="glyphicon glyphicon-search"></span>Search</button>
        </form>
    </div>

</nav>
<div id="postEventOptions">
    <div class="nav flex-column nav-pills col-md-12 bg-primary">
        <ul class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <li><a class="nav-link" id="list-questions" data-toggle="modal"
                   data-target="#modalPostEvent">Post New Event</a></li>
        </ul>
    </div>
</div>


<!-- The Modal -->
<div class="modal fade" id="modalPostEvent">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Post New Event</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form method="post" action="./userController.php" id="eventForm">
                    <div class="form-group row" id="hiddenInputValues" style="display: none;">
                        <input type="hidden" name="PAGE" value="LOGGED_IN"/>
                        <input type="hidden" id="commandInput" name="COMMAND" value="POST_EVENT"/>
                    </div>

                    <div class="form-group row" id="eventNameRow">
                        <label for="inputEventName" class="col-sm-4 col-form-label">Event Name:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="EVENTNAME" maxlength="45" id="inputEventName"
                                   placeholder="Event Name"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="EVENT_DESCRIPTION" class="col-sm-4 col-form-label">Event Description:</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="EVENTDESCRIPTION" id="inputEventDescription"
                                   placeholder="......."
                                      required=""></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEventDate" class="col-sm-4 col-form-label">Event Date:</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" name="EVENTDATE" id="inputEventDate"
                                   placeholder="DD/MM/YY" required=""/>
                            <!--pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$"-->
                        </div>
                    </div>

                    <div class="form-group row" >
                        <label for="inputEventPrice" class="col-sm-4 col-form-label">Price:</label>
                        <div class="col-sm-8">
                            <input type="number"  class="form-control" name="EVENTPRICE"
                                   id="inputEventPrice"
                                   placeholder="$###.###" required=""/>
                        </div>
                    </div>

                    <div class="form-group row" id="addressRow">
                        <label for="inputEventAddress" class="col-sm-4 col-form-label">Address: </label>
                        <div class="col-sm-8">
                            <input type="text" maxlength="35" class="form-control" name="EVENT_ADDRESS"
                                   id="inputEventAddress" placeholder="Street Address" required=""/>
                        </div>
                    </div>

                    <div class="form-group row" id="cityRow">
                        <label for="city" class="col-sm-4 col-form-label">City: </label>
                        <div class="col-sm-8">
                            <input type="text" maxlength="25" class="form-control" name="CITY"
                                   id="city" placeholder="City" required=""/>
                        </div>
                    </div>

                    <div class="form-group row" id="stateRow">
                        <label for="state" class="col-sm-4 col-form-label">State:</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="STATE" id="state" required="">
                                <option>AB</option>
                                <option>BC</option>
                                <option>MN</option>
                                <option>NB</option>
                                <option>NF</option>
                                <option>NS</option>
                                <option>ON</option>
                                <option>PE</option>
                                <option>QB</option>
                                <option>SK</option>
                                <option>NU</option>
                                <option>YU</option>
                            </select>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <button type="submit" onclick="$('#eventForm').submit();" class="btn btn-success" data-dismiss="modal">Post</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </form>
            </div>

        </div>
    </div>
</div>


<div class="container-fluid jumbotron" id="eventScrollBack">

    <div class="container" id="eventScrollList">


        <div class="card container bg-light" id="eventBody">
            <div class="card-body" id="eventContent">
                <h5 class="card-title" id="eventName">Event Name</h5>
                <h6 class="card-subtitle mb-2 text-muted" id="eventLocation" style="display: inline-block;">Card
                    subtitle</h6>
                <h6 class="card-subtitle mb-2 text-muted" id="eventDate" style="display:inline-block; float: right;">
                    Card subtitle</h6>
                <p class="card-text" id="eventDescription">Some quick example text to build on the card title and make
                    up the bulk of the card's content.</p>
                <a href="#" class="card-link">
                    <button class="btn btn-primary">Save Event</button>
                </a>
                <a href="#" id="registerButton" class="card-link" style="float: right">
                    <button class="btn btn-warning">Attend Event/ Register</button>
                </a>
            </div>
        </div>
        <div class="card container bg-light" id="eventBody">
            <div class="card-body" id="eventContent">
                <h5 class="card-title" id="eventName">Event Name</h5>
                <h6 class="card-subtitle mb-2 text-muted" id="eventLocation" style="display: inline-block;">Card
                    subtitle</h6>
                <h6 class="card-subtitle mb-2 text-muted" id="eventDate" style="display:inline-block; float: right;">
                    Card subtitle</h6>
                <p class="card-text" id="eventDescription">Some quick example text to build on the card title and make
                    up the bulk of the card's content.</p>
                <a href="#" class="card-link">
                    <button class="btn btn-primary">Save Event</button>
                </a>
                <a href="#" id="registerButton" class="card-link" style="float: right">
                    <button class="btn btn-warning">Attend Event/ Register</button>
                </a>
            </div>
        </div>
    </div>

</div>

</body>
</html>