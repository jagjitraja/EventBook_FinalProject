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
</html>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="margin:0">
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
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="text" placeholder="Search Events">
            <button class="btn btn-success my-2 my-sm-0"><span class="glyphicon glyphicon-search"></span>Search</button>
        </form>
    </div>

</nav>


</body>
</html>