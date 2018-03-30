
<!DOCTYPE html>
<html>
<head>

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


    <script>
        function getAllEvents(command) {

            if ( typeof command === 'undefined'){
                alert("Please Refresh, an error occured");
                return;
            }

            var query = {PAGE:'LOGGED_IN',COMMAND:command};
            $.ajax({url:'eventController.php',type:'post',data:query,
                success:function(result){
                    console.log(result);
                    $("#eventScrollList").html('');
                    $("#eventScrollList").prepend(result);
                },
                fail:function (XMLHttpRequest, textStatus, error) {
                    alert("FAILED");
                }
            });
        }


        $(document).ready(function () {

            getAllEvents('GET_ALL_EVENTS');

            $("#submit_post_event").click(function () {
                var formInputArray = $("#eventForm").serializeArray();
                var fieldsValuesArray = {};

                $.each(formInputArray,function (i,field) {
                    var nam = field.name;
                    var val = field.value;
                    fieldsValuesArray[nam] = val;
                });

                var query = {EVENT_DATA:fieldsValuesArray};
                $.ajax({url: "./eventController.php", type:"post",data:query,
                    success: function(result){
                        $('#eventScrollList').prepend(result);
                        $('#modalPostEvent').modal('toggle');

                },  fail:function (XMLHttpRequest, textStatus, error) {
                        alert("An error occured posting the event. Please try again :(");
                    }});
            });
        });
    </script>
</head>

<body>


<nav id="navBar" class="navbar navbar-expand-md navbar-light bg-success fixed-top" style="margin:0">
    <a class="navbar-brand" onclick="getAllEvents('GET_ALL_EVENTS')" ">EventBook</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#myNavBar">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="myNavBar">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" id="postedEvents" onclick="getAllEvents('GET_MY_EVENTS')">My Posted Events</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="savedEvents" onclick="showModal(this.id)">Saved Events</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="myProfile" onclick="showModal(this.id)">My Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="myProfile" onclick="$('#signOutForm').submit()">Logout</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="text" placeholder="Search Events"/>
            <button class="btn btn-dark my-2 my-sm-0"><span class="glyphicon glyphicon-search"></span>Search</button>
        </form>
    </div>

</nav>
<div id="postEventOptions">
    <div class="col-sm-12">
        <ul class="nav flex-column" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <li class="nav-item bg-danger text-light"><a class="nav-link" id="list-questions" data-toggle="modal" data-target="#modalPostEvent">Post New Event</a></li>
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
                <form id="eventForm">
                    <div class="form-group row" id="hiddenInputValues" style="display: none;">
                        <input type="hidden" name="PAGE" value="LOGGED_IN"/>
                        <input type="hidden" id="commandInput" name="COMMAND" value="POST_EVENT"/>
                    </div>

                    <div class="form-group row" id="eventNameRow">
                        <label for="inputEventName" class="col-sm-4 col-form-label">Event Name:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="EVENTNAME" maxlength="45" id="inputEventName"
                                   placeholder="Event Name" required/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="EVENT_DESCRIPTION" class="col-sm-4 col-form-label">Event Description:</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="EVENTDESCRIPTION" id="inputEventDescription"
                                   placeholder="......." required></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEventDate" class="col-sm-4 col-form-label">Event Date:</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" name="EVENTDATE" id="inputEventDate"
                                   placeholder="DD/MM/YY" required/>
                            <!--pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$"-->
                        </div>
                    </div>

                    <div class="form-group row" >
                        <label for="inputEventPrice" class="col-sm-4 col-form-label">Price:</label>
                        <div class="col-sm-8">
                            <input type="number"  class="form-control" name="EVENTPRICE"
                                   id="inputEventPrice" placeholder="$###.###" required/>
                        </div>
                    </div>


                    <div class="form-group row" id="addressRow">
                        <label for="inputEventAddress" class="col-sm-4 col-form-label">Address: </label>
                        <div class="col-sm-8">
                            <input type="text" maxlength="35" class="form-control" name="EVENTADDRESS"
                                   id="inputEventAddress" placeholder="Street Address" required/>
                        </div>
                    </div>

                    <div class="form-group row" id="cityRow">
                        <label for="city" class="col-sm-4 col-form-label">City: </label>
                        <div class="col-sm-8">
                            <input type="text" maxlength="25" class="form-control" name="EVENTCITY"
                                   id="city" placeholder="City" required/>
                        </div>
                    </div>

                    <div class="form-group row" id="stateRow">
                        <label for="state" class="col-sm-4 col-form-label">State:</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="EVENTSTATE" id="state" required>
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
                    <button type="button" id="submit_post_event" class="btn btn-success">Post</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </form>
            </div>

        </div>
    </div>
</div>


<div class="container-fluid jumbotron" id="eventScrollBack">

    <div class="container" id="eventScrollList">


    </div>
</div>


<form id="signOutForm" style="display: none" action="userController.php" method="post">
    <input type="hidden" name="PAGE" value="LOGGED_IN"/>
    <input type="hidden" name="COMMAND" value="SIGN_OUT"/>
</form>

</body>
</html>