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

<nav id="navBar" class="navbar navbar-light bg-primary fixed-top" style="margin:0">
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
            <button class="btn btn-success my-2 my-sm-0"><span class="glyphicon glyphicon-search"></span>Search</button>
        </form>
    </div>

</nav>

<div class="container-fluid jumbotron" id="eventScrollBack">

    <div class="container" id="eventScrollList">


        <div class="card container bg-light" id="eventBody">
            <div class="card-body" id="eventContent">
                <h5 class="card-title" id="eventName">Event Name</h5>
                <h6 class="card-subtitle mb-2 text-muted" id="eventLocation" style="display: inline-block;">Card subtitle</h6>
                <h6 class="card-subtitle mb-2 text-muted" id="eventDate" style="display:inline-block; float: right;">Card subtitle</h6>
                <p class="card-text" id="eventDescription">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="card-link"><button class="btn btn-primary">Save Event</button></a>
                <a href="#" id="registerButton" class="card-link" style="float: right"><button class="btn btn-warning">Attend Event/ Register</button></a>
            </div>
        </div>
        <div class="card container bg-light" id="eventBody">
            <div class="card-body" id="eventContent">
                <h5 class="card-title" id="eventName">Event Name</h5>
                <h6 class="card-subtitle mb-2 text-muted" id="eventLocation" style="display: inline-block;">Card subtitle</h6>
                <h6 class="card-subtitle mb-2 text-muted" id="eventDate" style="display:inline-block; float: right;">Card subtitle</h6>
                <p class="card-text" id="eventDescription">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="card-link"><button class="btn btn-primary">Save Event</button></a>
                <a href="#" id="registerButton" class="card-link" style="float: right"><button class="btn btn-warning">Attend Event/ Register</button></a>
            </div>
        </div>
        <div class="card container bg-light" id="eventBody">
            <div class="card-body" id="eventContent">
                <h5 class="card-title" id="eventName">Event Name</h5>
                <h6 class="card-subtitle mb-2 text-muted" id="eventLocation" style="display: inline-block;">Card subtitle</h6>
                <h6 class="card-subtitle mb-2 text-muted" id="eventDate" style="display:inline-block; float: right;">Card subtitle</h6>
                <p class="card-text" id="eventDescription">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="card-link"><button class="btn btn-primary">Save Event</button></a>
                <a href="#" id="registerButton" class="card-link" style="float: right"><button class="btn btn-warning">Attend Event/ Register</button></a>
            </div>
        </div>
        <div class="card container bg-light" id="eventBody">
            <div class="card-body" id="eventContent">
                <h5 class="card-title" id="eventName">Event Name</h5>
                <h6 class="card-subtitle mb-2 text-muted" id="eventLocation" style="display: inline-block;">Card subtitle</h6>
                <h6 class="card-subtitle mb-2 text-muted" id="eventDate" style="display:inline-block; float: right;">Card subtitle</h6>
                <p class="card-text" id="eventDescription">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="card-link"><button class="btn btn-primary">Save Event</button></a>
                <a href="#" id="registerButton" class="card-link" style="float: right"><button class="btn btn-warning">Attend Event/ Register</button></a>
            </div>
        </div>
        <div class="card container bg-light" id="eventBody">
            <div class="card-body" id="eventContent">
                <h5 class="card-title" id="eventName">Event Name</h5>
                <h6 class="card-subtitle mb-2 text-muted" id="eventLocation" style="display: inline-block;">Card subtitle</h6>
                <h6 class="card-subtitle mb-2 text-muted" id="eventDate" style="display:inline-block; float: right;">Card subtitle</h6>
                <p class="card-text" id="eventDescription">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="card-link"><button class="btn btn-primary">Save Event</button></a>
                <a href="#" id="registerButton" class="card-link" style="float: right"><button class="btn btn-warning">Attend Event/ Register</button></a>
            </div>
        </div>
        <div class="card container bg-light" id="eventBody">
            <div class="card-body" id="eventContent">
                <h5 class="card-title" id="eventName">Event Name</h5>
                <h6 class="card-subtitle mb-2 text-muted" id="eventLocation" style="display: inline-block;">Card subtitle</h6>
                <h6 class="card-subtitle mb-2 text-muted" id="eventDate" style="display:inline-block; float: right;">Card subtitle</h6>
                <p class="card-text" id="eventDescription">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="card-link"><button class="btn btn-primary">Save Event</button></a>
                <a href="#" id="registerButton" class="card-link" style="float: right"><button class="btn btn-warning">Attend Event/ Register</button></a>
            </div>
        </div>
        <div class="card container bg-light" id="eventBody">
            <div class="card-body" id="eventContent">
                <h5 class="card-title" id="eventName">Event Name</h5>
                <h6 class="card-subtitle mb-2 text-muted" id="eventLocation" style="display: inline-block;">Card subtitle</h6>
                <h6 class="card-subtitle mb-2 text-muted" id="eventDate" style="display:inline-block; float: right;">Card subtitle</h6>
                <p class="card-text" id="eventDescription">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="card-link"><button class="btn btn-primary">Save Event</button></a>
                <a href="#" id="registerButton" class="card-link" style="float: right"><button class="btn btn-warning">Attend Event/ Register</button></a>
            </div>
        </div>
        <div class="card container bg-light" id="eventBody">
            <div class="card-body" id="eventContent">
                <h5 class="card-title" id="eventName">Event Name</h5>
                <h6 class="card-subtitle mb-2 text-muted" id="eventLocation" style="display: inline-block;">Card subtitle</h6>
                <h6 class="card-subtitle mb-2 text-muted" id="eventDate" style="display:inline-block; float: right;">Card subtitle</h6>
                <p class="card-text" id="eventDescription">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="card-link"><button class="btn btn-primary">Save Event</button></a>
                <a href="#" id="registerButton" class="card-link" style="float: right"><button class="btn btn-warning">Attend Event/ Register</button></a>
            </div>
        </div>
        <div class="card container bg-light" id="eventBody">
            <div class="card-body" id="eventContent">
                <h5 class="card-title" id="eventName">Event Name</h5>
                <h6 class="card-subtitle mb-2 text-muted" id="eventLocation" style="display: inline-block;">Card subtitle</h6>
                <h6 class="card-subtitle mb-2 text-muted" id="eventDate" style="display:inline-block; float: right;">Card subtitle</h6>
                <p class="card-text" id="eventDescription">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="card-link"><button class="btn btn-primary">Save Event</button></a>
                <a href="#" id="registerButton" class="card-link" style="float: right"><button class="btn btn-warning">Attend Event/ Register</button></a>
            </div>
        </div>
        <div class="card container bg-light" id="eventBody">
            <div class="card-body" id="eventContent">
                <h5 class="card-title" id="eventName">Event Name</h5>
                <h6 class="card-subtitle mb-2 text-muted" id="eventLocation" style="display: inline-block;">Card subtitle</h6>
                <h6 class="card-subtitle mb-2 text-muted" id="eventDate" style="display:inline-block; float: right;">Card subtitle</h6>
                <p class="card-text" id="eventDescription">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="card-link"><button class="btn btn-primary">Save Event</button></a>
                <a href="#" id="registerButton" class="card-link" style="float: right"><button class="btn btn-warning">Attend Event/ Register</button></a>
            </div>
        </div>
        <div class="card container bg-light" id="eventBody">
            <div class="card-body" id="eventContent">
                <h5 class="card-title" id="eventName">Event Name</h5>
                <h6 class="card-subtitle mb-2 text-muted" id="eventLocation" style="display: inline-block;">Card subtitle</h6>
                <h6 class="card-subtitle mb-2 text-muted" id="eventDate" style="display:inline-block; float: right;">Card subtitle</h6>
                <p class="card-text" id="eventDescription">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="card-link"><button class="btn btn-primary">Save Event</button></a>
                <a href="#" id="registerButton" class="card-link" style="float: right"><button class="btn btn-warning">Attend Event/ Register</button></a>
            </div>
        </div>
        <div class="card container bg-light" id="eventBody">
            <div class="card-body" id="eventContent">
                <h5 class="card-title" id="eventName">Event Name</h5>
                <h6 class="card-subtitle mb-2 text-muted" id="eventLocation" style="display: inline-block;">Card subtitle</h6>
                <h6 class="card-subtitle mb-2 text-muted" id="eventDate" style="display:inline-block; float: right;">Card subtitle</h6>
                <p class="card-text" id="eventDescription">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="card-link"><button class="btn btn-primary">Save Event</button></a>
                <a href="#" id="registerButton" class="card-link" style="float: right"><button class="btn btn-warning">Attend Event/ Register</button></a>
            </div>
        </div>
        <div class="card container bg-light" id="eventBody">
            <div class="card-body" id="eventContent">
                <h5 class="card-title" id="eventName">Event Name</h5>
                <h6 class="card-subtitle mb-2 text-muted" id="eventLocation" style="display: inline-block;">Card subtitle</h6>
                <h6 class="card-subtitle mb-2 text-muted" id="eventDate" style="display:inline-block; float: right;">Card subtitle</h6>
                <p class="card-text" id="eventDescription">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="card-link"><button class="btn btn-primary">Save Event</button></a>
                <a href="#" id="registerButton" class="card-link" style="float: right"><button class="btn btn-warning">Attend Event/ Register</button></a>
            </div>
        </div>
        <div class="card container bg-light" id="eventBody">
            <div class="card-body" id="eventContent">
                <h5 class="card-title" id="eventName">Event Name</h5>
                <h6 class="card-subtitle mb-2 text-muted" id="eventLocation" style="display: inline-block;">Card subtitle</h6>
                <h6 class="card-subtitle mb-2 text-muted" id="eventDate" style="display:inline-block; float: right;">Card subtitle</h6>
                <p class="card-text" id="eventDescription">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="card-link"><button class="btn btn-primary">Save Event</button></a>
                <a href="#" id="registerButton" class="card-link" style="float: right"><button class="btn btn-warning">Attend Event/ Register</button></a>
            </div>
        </div>
        <div class="card container bg-light" id="eventBody">
            <div class="card-body" id="eventContent">
                <h5 class="card-title" id="eventName">Event Name</h5>
                <h6 class="card-subtitle mb-2 text-muted" id="eventLocation" style="display: inline-block;">Card subtitle</h6>
                <h6 class="card-subtitle mb-2 text-muted" id="eventDate" style="display:inline-block; float: right;">Card subtitle</h6>
                <p class="card-text" id="eventDescription">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="card-link"><button class="btn btn-primary">Save Event</button></a>
                <a href="#" id="registerButton" class="card-link" style="float: right"><button class="btn btn-warning">Attend Event/ Register</button></a>
            </div>
        </div>

    </div>
</div>

</body>
</html>