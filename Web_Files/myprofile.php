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

        });

        function showEditEventModal(e) {
            alert(e);
        }

        function loadMyPostedEvents(userID) {

            var query = {PAGE:'MY_PROFILE',COMMAND:'GET_MY_EVENTS',USER_ID:userID};
            $.ajax({url:'eventController.php',type:'post',data:query,
                success:function(result){
                    //console.log(result);
                    $("#eventScrollList").html('');
                    $("#eventScrollList").prepend(result);
                    $(".eventOwnerButtons").show();
                    $(".eventOwnerButtons").click(function () {
                        showEditEventModal(this);
                    });
                },
                fail:function (XMLHttpRequest, textStatus, error) {
                    alert("FAILED");
                }
            });
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
            <input type="hidden" id="commandInput" name="COMMAND" value="UPDATE_PROFILE"/>
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
    <div class="container" id="eventScrollList">


    </div>
</div>

</body>
</html>