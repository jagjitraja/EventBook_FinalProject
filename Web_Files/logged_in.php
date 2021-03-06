
<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">
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

        function getAllEvents(command,title,type) {
            $("#eventScrollList").html('');
            if ( typeof command === 'undefined'){
                alert("Please Refresh, an error occured");
                return;
            }
            if (title==null){
                title = 'All Events';
            }
            console.log(title+"   "+type+"  "+command);
            $('#pageTitle').html('<h3>'+title+'</h3>');

            var query = {PAGE:'LOGGED_IN',COMMAND:command,SELECT_TYPE:type};

            $.ajax({url:'eventController.php',type:'post',data:query,
                success:function(result){
                    //console.log(result);
                    $("#eventScrollList").html(result);
                    $(".eventButton").click(function (e) {
                        updateUserAndEventData(e);
                    });
                    //command==='REGISTERED_EVENTS'||
                    if (command==='GET_MY_SAVED_EVENTS'){

                        $("#savedEvents").addClass("active");
                        $("#registerEvents").removeClass("active");
                        $(".removeEvent").show();
                        $(".saveEvent").hide();

                        $("#removeEvent").click(function (e) {
                            alert("Eeeeeeeee");
                            var eventID = e.target.value;
                            query = {PAGE:'LOGGED_IN',COMMAND:"REMOVE_SAVED_EVENT",EVENT_ID:eventID};
                            $.ajax({url:'eventController.php',type:'post',data:query,
                                success:function(result){
                                    console.log(result);
                                    $("#eventScrollList").html('');
                                    getAllEvents('GET_ALL_EVENTS',null,"ALL");
                                },
                                fail:function (XMLHttpRequest, textStatus, error) {
                                    alert("Failed to Update Event :(");
                                }
                            });
                        });
                    }else if (command==='REGISTERED_EVENTS'){

                        $("#registerEvents").addClass("active");
                        $("#savedEvents").removeClass("active");
                        $(".removeEvent").show();
                        $(".attendEvent").hide();

                        $("#removeEvent").click(function (e) {
                            alert("BBBBBBBBBBB");
                            var eventID = e.target.value;
                            query = {PAGE:'LOGGED_IN',COMMAND:"REMOVE_ATTENDING_EVENT",EVENT_ID:eventID};
                            $.ajax({url:'eventController.php',type:'post',data:query,
                                success:function(result){
                                    console.log(result);
                                    $("#eventScrollList").html('');
                                    getAllEvents('GET_ALL_EVENTS',null,"ALL");
                                },
                                fail:function (XMLHttpRequest, textStatus, error) {
                                    alert("Failed to Update Event :(");
                                }
                            });
                        });
                    }

                    $("#eventFilterTitle").html(type+" EVENTS");
                },
                fail:function (XMLHttpRequest, textStatus, error) {
                    alert("FAILED");
                }
            });
        }

        function updateUserAndEventData(e) {
            //TODO: Set active on button clicked
            var buttonID = e.target.id;
            var eventID = e.target.value;
            var query = {PAGE:'LOGGED_IN',COMMAND:'GET_ALL_EVENTS'};
            switch (buttonID){
                case 'saveEvent':
                    query = {PAGE:'LOGGED_IN',COMMAND:"SAVE_EVENT",EVENT_ID:eventID};
                    break;
                case 'attendEvent':
                    query = {PAGE:'LOGGED_IN',COMMAND:"ATTEND_EVENT",EVENT_ID:eventID};
                    break;
                default:
                    break;
            }

            $.ajax({url:'eventController.php',type:'post',data:query,
                success:function(result){
                    console.log(result);
                    $('#resultTitle').html(result);
                    $('#resultModal').modal('toggle');
                },
                fail:function (XMLHttpRequest, textStatus, error) {
                    alert("Failed to Update Event :(");
                }
            });
        }
        function search () {
            var criteria = $("#searchField").val();
            if (criteria.length>0){
                var query = {PAGE:'HOME',COMMAND:'SEARCH',CRITERIA:criteria,SELECT_TYPE:'ALL'};

                $.ajax({url:'eventController.php',type:'post',data:query,
                    success:function(result){
                        $("#eventScrollList").html('');
                        $("#eventScrollList").append(result);

                        $(".eventButton").click(function () {
                            showModal("signInAnchor");
                        });
                    },
                    fail:function (XMLHttpRequest, textStatus, error) {
                        alert("FAILED");
                    }
                });
            }
        }

        $(document).ready(function () {

            getAllEvents('GET_ALL_EVENTS',null,"ALL");

            $("#submit_post_event").click(function () {

                var formInputArray = $("#eventForm").serializeArray();
                var fieldsValuesArray = {};

                $("#inputEventName").prop('required',true);
                $("#inputEventDescription").prop('required',true);
                $("#inputEventDate").prop('required',true);
                $("#inputEventPrice").prop('required',true);
                $("#inputEventAddress").prop('required',true);
                $("#city").prop('required',true);
                $("#state").prop('required',true);

                var empty = false;
                var emptyField= "";
                $.each(formInputArray,function (i,field) {
                    var nam = field.name;
                    var val = field.value;
                    if (val==""){
                        empty = true;
                        var input = $("[name ='"+nam+"']");
                        var label = $("label[for='"+input[0].id+"']");
                        emptyField = label.html();
                    }
                    fieldsValuesArray[nam] = val;
                });

                if (empty){
                    alert("Please fill in the "+ emptyField+" field");
                    return false;
                } else {

                    var query = {EVENT_DATA: fieldsValuesArray};
                    $.ajax({
                        url: "./eventController.php", type: "post", data: query,
                        success: function (result){
                            getAllEvents('GET_ALL_EVENTS', null, "ALL");
                            $('#modalPostEvent').modal('toggle');
                        }, fail: function (XMLHttpRequest, textStatus, error) {
                            alert("An error occured posting the event. Please try again :(");
                        }
                    });

                    $("#eventForm").trigger('reset');
                }
            });

        });

    </script>
</head>

<body>


<nav id="navBar" class="navbar navbar-expand-md navbar-light bg-success fixed-top" style="margin:0;z-index: 10000;">
    <a class="navbar-brand active" onclick="getAllEvents('GET_ALL_EVENTS',null,'ALL')">EventBook</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#myNavBar">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="myNavBar">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" id="registerEvents" onclick="getAllEvents('REGISTERED_EVENTS',this.name,'ALL')" data-target="#myNavBar"data-toggle="collapse" name = "My Registered Events">My Registered Events</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="savedEvents" onclick="getAllEvents('GET_MY_SAVED_EVENTS',this.name,'ALL')" data-target="#myNavBar"data-toggle="collapse"name = "My Saved Events">Saved Events</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="myProfile" onclick="$('#goToProfileForm').submit()"  data-target="#myNavBar" data-toggle="collapse" name = "My Profile">My Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="logout" onclick="$('#signOutForm').submit()">Logout</a>
            </li>
        </ul>
            <input class="form-control " type="text" placeholder="Search Events" id="searchField" onkeydown="search()"/>
            <button class="btn btn-dark" id="searchButton"type="button"  data-target="#myNavBar" data-toggle="collapse" onclick="search()">Search</button>
    </div>
</nav>
<div id="postEventOptions">
    <div class="col-sm-12">
        <ul class="nav flex-column" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <li class="nav-item bg-danger text-light"><a class="nav-link" id="list-questions"
                                                         data-toggle="modal" data-target="#modalPostEvent">Post New Event</a></li>
        </ul>
    </div>

    <div class="dropdown">
        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><span id="eventFilterTitle">Filter Event Type</span><span class="caret"></span></button>
        <ul class="dropdown-menu">
            <a class="nav-link" onclick="getAllEvents('GET_ALL_EVENTS',null,this.name)" name="ALL">All</a>
            <a class="nav-link" onclick="getAllEvents('GET_ALL_EVENTS',null,this.name)" name="EDUCATIONAL">Educational</a>
            <a class="nav-link" onclick="getAllEvents('GET_ALL_EVENTS',null,this.name)" name="BUSINESS">Business</a>
            <a class="nav-link" onclick="getAllEvents('GET_ALL_EVENTS',null,this.name)" name="SOCIAL">Social</a>
            <a class="nav-link" onclick="getAllEvents('GET_ALL_EVENTS',null,this.name)" name="PARTY">Party</a>
            <a class="nav-link" onclick="getAllEvents('GET_ALL_EVENTS',null,this.name)" name="SPORTS">Sports</a>
           <a class="nav-link" onclick="getAllEvents('GET_ALL_EVENTS',null,this.name)" name="AWARDS">Awards</a>
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
                                   placeholder="Event Name" required=""/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="EVENT_DESCRIPTION" class="col-sm-4 col-form-label">Event Description:</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="EVENTDESCRIPTION" id="inputEventDescription"
                                   placeholder="......." required=""></textarea>
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

                    <div class="form-group row">
                        <label for="inputEventType" class="col-sm-4 col-form-label">Event Type:</label>
                        <div class="col-sm-8">
                            <select class="dropdown btn btn-dark" name="EVENTTYPE">
                                    <option class = "nav-link" value = "Educational">Educational</option>
                                    <option class = "nav-link" value = "Business">Business</option>
                                    <option class = "nav-link" value = "Social">Social</option>
                                    <option class = "nav-link" value = "Party">Party</option>
                                    <option class = "nav-link" value = "Sports">Sports</option>
                                    <option class = "nav-link" value = "Awards">Awards</option>
                            </select>
                    </div>
                    </div>

                    <div class="form-group row" >
                        <label for="inputEventPrice" class="col-sm-4 col-form-label">Price:</label>
                        <div class="col-sm-8">
                            <input type="number"  class="form-control" name="EVENTPRICE"
                                   id="inputEventPrice" placeholder="$###.###" required=""/>
                        </div>
                    </div>

                    <div class="form-group row" id="addressRow">
                        <label for="inputEventAddress" class="col-sm-4 col-form-label">Address: </label>
                        <div class="col-sm-8">
                            <input type="text" maxlength="35" class="form-control" name="EVENTADDRESS"
                                   id="inputEventAddress" placeholder="Street Address" required=""/>
                        </div>
                    </div>

                    <div class="form-group row" id="cityRow">
                        <label for="city" class="col-sm-4 col-form-label">City: </label>
                        <div class="col-sm-8">
                            <input type="text" maxlength="25" class="form-control" name="EVENTCITY"
                                   id="city" placeholder="City" required=""/>
                        </div>
                    </div>

                    <div class="form-group row" id="stateRow">
                        <label for="state" class="col-sm-4 col-form-label">State:</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="EVENTSTATE" id="state" required="">
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

<form id="goToProfileForm" style="display: none" action="userController.php" method="post">
    <input type="hidden" name="PAGE" value="LOGGED_IN"/>
    <input type="hidden" name="COMMAND" value="MY_PROFILE"/>
</form>

</body>
</html>