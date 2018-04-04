<!DOCTYPE>
<html>
<head>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"/>
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="./View_Styles_And_JS/homeStyles.css"/>
    <script src="./View_Styles_And_JS/homeFunctions.js" type="application/javascript"></script>


    <script>

        var myPostedEvents = [];

        $(document).ready(function () {

            var session_array = <?php echo json_encode($_SESSION);?>;
            console.log(session_array);
            var email= session_array['userEmail'];
            var USER_INFO = session_array['USER_INFO'];
            var name = USER_INFO['USER_NAME'];
            var city = USER_INFO['USER_CITY'];
            var password = USER_INFO['USER_PASSWORD'];
            var phone = USER_INFO['USER_PHONE_NUMBER'];
            var state = USER_INFO['USER_STATE'];

            $("#inputUserName").val(name);
            $("#inputUserEmail").val(email);
            $("#inputUserPhoneNumber").val(phone);
            $("#userCity").val(city);
            $("#userState").val(state);

            $("#userForm").submit(function (e) {
                if($("#inputPassword").val()===($("#inputPasswordConfirm").val())){
                    this.submit();
                }else{
                    alert("Both password fields must be equal");
                    e.preventDefault() ;
                }
            });
            loadMyPostedEvents(USER_INFO['User_ID']);

            $("#submit_update_event").click(function () {

                var formInputArray = $("#updateForm").serializeArray();
                var fieldsValuesArray = {};

                $.each(formInputArray,function (i,field) {
                    var nam = field.name;
                    var val = field.value;
                    fieldsValuesArray[nam] = val;
                });

                var query = {PAGE:'MY_PROFILE',COMMAND:'UPDATE_EVENTS',EVENT_DATA:fieldsValuesArray};
                $.ajax({url: "./eventController.php", type:"post",data:query,
                    success: function(result){
                        console.log(result);
                         $('#eventScrollList').html('');
                         loadMyPostedEvents(USER_INFO['User_ID']);
                         $('#modalEditEvent').modal('toggle');
                    },  fail:function (XMLHttpRequest, textStatus, error) {
                        alert("An error occured posting the event. Please try again :(");
                    }});

                $("#updateForm").trigger('reset');
            });


            $("#delete_event_confirm").click(function (e) {

                console.log($("#deleteEventID").val());
                var id = $("#deleteEventID").val();

                var query = {PAGE:'MY_PROFILE',COMMAND:'DELETE_EVENTS',EVENT_ID:id+""};
                $.ajax({url:'eventController.php',type:'post',data:query,
                    success:function(result){
                    console.log(result);
                        $('#eventScrollList').html('');
                        loadMyPostedEvents(USER_INFO['User_ID']);
                        $('#modalDeleteEvent').modal('toggle');
                    },
                    fail:function (XMLHttpRequest, textStatus, error) {
                        alert("FAILED");
                    }
                });
            });
        });


        function loadMyPostedEvents(userID) {

            var query = {PAGE:'MY_PROFILE',COMMAND:'GET_MY_EVENTS',USER_ID:userID};
            $.ajax({url:'eventController.php',type:'post',data:query,
                success:function(result){
                    myPostedEvents = JSON.parse(result);
                    console.log(myPostedEvents);
                    createEventLayouts();
                },
                fail:function (XMLHttpRequest, textStatus, error) {
                    alert("FAILED");
                }
            });
        }

        function createEventLayouts() {

            for (var index in myPostedEvents){
                var event = (myPostedEvents[index]);
                var str =  '<div class="card container bg-light border-info mb-3 eventBody">' +
                    '<div class = "btn-block float-right mb-2 mt-2 eventCardButtons">'+
                    '<button class="btn btn-info btn-sm editEventButton" title="Edit Event" value = "'+index+'" data-toggle="modal" data-target="#modalEditEvent">Edit</button>'+
                    '<button class="btn btn-danger btn-sm deleteEventButton" title="Delete Event"value = "'+index+'" data-toggle="modal" data-target="#modalDeleteEvent">Delete</button>'+
                    '</div>'+
                    '<div class="card-header">' +
                    '   <h6>Posted On: '+event["Event_Posting_Date"]+'</h6>' +
                    '   <h6 class="lead" style="float: right;">'+event["Event_Type"]+'</h6>' +
                    '</div>'+
                    '<div class="card-body" id="eventContent">'+
                    '<h5 class="card-title" id="eventName">'+event["Event_Name"]+'</h5>'+
                    '<h6 class="card-subtitle mb-2 text-muted" id="eventLocation" style="display: inline-block;">'+event["Event_City"]+', '+event["Eevnt_State"]+'</h6> ' +
                    '<h6 class="card-subtitle mb-2 text-muted" id="eventDate" style="display:inline-block; float: right;">'+event["Event_Date"]+'</h6>' +
                    '<p class="card-text text-justify" id="eventDescription">'+event["Event_Description"]+'</p>' +
                    '</div>' +
                    '</div>';

                $("#eventScrollList").prepend(str);

                $(".editEventButton").click(function (e) {

                    var index = (e.target.value);
                    var eventSelected = myPostedEvents[index];

                    var name = eventSelected['Event_Name'];
                    var description = eventSelected['Event_Description'];
                    var date = eventSelected['Event_Date'];
                    var type = eventSelected['Event_Type'];
                    var price = eventSelected['Event_Price'];
                    var address = eventSelected['Event_Address'];
                    var city = eventSelected['Event_City'];
                    var state = eventSelected['Eevnt_State'];
                    var id = eventSelected['Event_ID'];

                    $("#inputEditEventName").val(name);
                    $("#inputEditEventDescription").val(description);
                    $("#inputEditEventDate").val(date);
                    $("#inputEditEventType").val(type);
                    $("#inputEditEventPrice").val(price);
                    $("#inputEditEventAddress").val(address);
                    $("#EditCity").val(city);
                    $("#EditState").val(state);
                    $("#editEventID").val(id);
                    $("#deleteEventID").val(id);

                });

                $(".deleteEventButton").click(function (e) {

                    var index = (e.target.value);
                    var eventSelected = myPostedEvents[index];

                    var id = eventSelected['Event_ID'];

                    $("#deleteEventID").val(id);

                });
            }

        }


    </script>


</head>
<body>
<nav  class="navbar navbar-expand-md navbar-light bg-success" style="margin:0;z-index: 10000;">
    <a class="navbar-brand" onclick="getAllEvents('GET_ALL_EVENTS')">EventBook</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#myNavBar">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="myNavBar">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" id="postedEvents" onclick="$('#noChangeGoToEvents').submit();"
                   data-target="#myNavBar"data-toggle="collapse" name = "BACK">Back to Events</a>
            </li>
        </ul>
    </div>
</nav>
<div class="container" style="margin-top: 50px">
    <form id="userForm" method="post" action="./userController.php">
        <div class="form-group row" id="hiddenInputValues" style="display: none;">
            <input type="hidden" name="PAGE" value="LOGGED_IN"/>
            <input type="hidden" name="COMMAND" value="UPDATE_PROFILE"/>
        </div>

        <div class="form-group row" id="userNameRow">
            <label for="inputUserName" class="col-sm-4 col-form-label">User Name:</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="USER_NAME" maxlength="45" id="inputUserName"
                       placeholder="User Name" required/>
            </div>
        </div>
        <div class="form-group row">
            <label for="USER_EMAIL" class="col-sm-4 col-form-label">User Email:</label>
            <div class="col-sm-8"><input class="form-control" type="email" name="USER_EMAIL" id="inputUserEmail"
                                         placeholder="Email" required/>
            </div>
        </div>

        <div class="form-group row" id="phoneRow">
            <label for="inputUserPhoneNumber" class="col-sm-4 col-form-label">Phone Number: </label>
            <div class="col-sm-8">
                <input type="tel" maxlength="35" class="form-control" name="USERPHONE"
                       id="inputUserPhoneNumber" placeholder="Phone Number" required/>
            </div>
        </div>

        <div class="form-group row" id="cityRow">
            <label for="city" class="col-sm-4 col-form-label">City: </label>
            <div class="col-sm-8">
                <input type="text" maxlength="25" class="form-control" name="USERCITY"
                       id="userCity" placeholder="City" required/>
            </div>
        </div>

        <div class="form-group row" id="stateRow">
            <label for="state" class="col-sm-4 col-form-label">State:</label>
            <div class="col-sm-8">
                <select class="form-control" name="USERSTATE" id="userState" required>
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

        <div class="form-group row">
            <label for="inputPassword" class="col-sm-4 col-form-label">Password:</label>
            <div class="col-sm-8">
                <input type="password" class="form-control" name="PASSWORD" id="inputPassword"
                       placeholder="Password" minlength="8" maxlength="30"
                       title="Please enter atleast one number, one lowercase character and one uppercase character"
                       required=""/>
                <!--pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$"-->
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPasswordConfirm" class="col-sm-4 col-form-label">Confirm Password:</label>
            <div class="col-sm-8">
                <input type="password" class="form-control" name="PASSWORD" id="inputPasswordConfirm"
                       placeholder="Confirm Password" minlength="8" maxlength="30"
                       title="Please enter atleast one number, one lowercase character and one uppercase character"
                       required=""/>
                <!--pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$"-->
            </div>
        </div>

        <!-- Modal footer -->
        <button type="submit" id="submit_user_profile" class="btn btn-success">Update</button>
        <button type="button" class="btn btn-danger" onclick="$('#noChangeGoToEvents').submit();"data-dismiss="modal">Exit</button>
    </form>

</div>
<form id="noChangeGoToEvents" style="display: none" action="userController.php" method="post">
    <input type="hidden" name="PAGE" value="LOGGED_IN"/>
    <input type="hidden" name="COMMAND" value="EVENTS_NO_CHANGE"/>
</form>
<div class="container-fluid jumbotron" id="eventScrollBack">
    <h6 class="display-4 text-center">My Events</h6>
    <div class="container" id="eventScrollList" style="padding-top: 30px">


    </div>
</div>
<div class="modal fade" id="modalEditEvent">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" >
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Edit Event</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form id="updateForm">
                    <div class="form-group row" id="hiddenInputValues" style="display: none;">
                        <input type="hidden" name="PAGE" value="MY_PROFILE"/>
                        <input type="hidden" name="COMMAND" value="UPDATE_EVENT"/>
                        <input type="hidden" name="EVENT_ID" id="editEventID"/>
                    </div>

                    <div class="form-group row" id="eventNameRow">
                        <label for="inputEditEventName" class="col-sm-4 col-form-label">Event Name:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="EVENTNAME" maxlength="45" id="inputEditEventName"
                                   placeholder="Event Name" required/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEditEventDescription" class="col-sm-4 col-form-label">Event Description:</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="EVENTDESCRIPTION" id="inputEditEventDescription"
                                      placeholder="......." required></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEditEventDate" class="col-sm-4 col-form-label">Event Date:</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" name="EVENTDATE" id="inputEditEventDate"
                                   placeholder="DD/MM/YY" required/>
                            <!--pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$"-->
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEditEventType" class="col-sm-4 col-form-label">Event Type:</label>
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
                        <label for="inputEditEventPrice" class="col-sm-4 col-form-label">Price:</label>
                        <div class="col-sm-8">
                            <input type="number"  class="form-control" name="EVENTPRICE"
                                   id="inputEditEventPrice" placeholder="$###.###" required/>
                        </div>
                    </div>

                    <div class="form-group row" id="addressRow">
                        <label for="inputEditEventAddress" class="col-sm-4 col-form-label">Address: </label>
                        <div class="col-sm-8">
                            <input type="text" maxlength="35" class="form-control" name="EVENTADDRESS"
                                   id="inputEditEventAddress" placeholder="Street Address" required/>
                        </div>
                    </div>

                    <div class="form-group row" id="cityRow">
                        <label for="EditCity" class="col-sm-4 col-form-label">City: </label>
                        <div class="col-sm-8">
                            <input type="text" maxlength="25" class="form-control" name="EVENTCITY"
                                   id="EditCity" placeholder="City" required/>
                        </div>
                    </div>

                    <div class="form-group row" id="stateRow">
                        <label for="EditState" class="col-sm-4 col-form-label">State:</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="EVENTSTATE" id="EditState" required>
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
                    <button type="button" id="submit_update_event" class="btn btn-success">Update</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </form>
            </div>

        </div>
    </div>
</div>
<div class="modal fade" id="modalDeleteEvent">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Delete Event</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form id="deleteForm">
                    <div class="form-group row" id="hiddenInputValues" style="display: none;">
                        <input type="hidden" name="PAGE" value="MY_PROFILE"/>
                        <input type="hidden" name="COMMAND" value="DELETE_EVENT"/>
                        <input type="hidden" name="EVENT_ID" id="deleteEventID"/>
                    </div>

                    <h5 class="lead">Are you sure you want to delete this event?</h5>
                    <!-- Modal footer -->
                    <button type="button" id="delete_event_confirm" class="btn btn-success">Yes</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </form>
            </div>

        </div>
    </div>
</div>
</body>
</html>