<!DOCTYPE hmtl>
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
        function hideModal() {
            $("#modalForm").trigger('reset');
            $("#blanket").hide("slow");
            $("#modalDiv").hide("slow");
            $("#error").html("");
            $("#error").hide();
        }

        function showModal(e) {
            var modalHeaderValue = "";
            switch (e) {
                case "signInAnchor":
                    modalHeaderValue = "Sign In";
                    $("#userNameRow").hide();
                    $("#phoneRow").hide();
                    $("#cityRow").hide();
                    $("#stateRow").hide();
                    $("#submitButton").html("SignIn");
                    $("#inputPassword").prop('required', true);
                    $("#inputEmail").prop('required', true);


                    $("#inputPassword").prop('required', false);
                    $("#inputUserName").prop('required', false);
                    $("#city").prop('required', false);
                    $("#state").prop('required', false);
                    $("#inputPhoneNumber").prop('required', false);

                    submitMode = 1;
                    break;

                case "registerAnchor":
                    modalHeaderValue = "Register"
                    $("#userNameRow").show();
                    $("#phoneRow").show();
                    $("#submitButton").html("Register");
                    $("#inputEmail").prop('required', true);
                    $("#inputPhoneNumber").prop('required', true);
                    $("#inputPassword").prop('required', true);
                    $("#inputUserName").prop('required', true);
                    $("#cityRow").show();
                    $("#stateRow").show();
                    $("#city").prop('required', true);
                    $("#state").prop('required', true);
                    submitMode = 2;
                    break;

                default:

                    $("#inputPassword").prop('required', false);
                    $("#inputUserName").prop('required', false);
                    $("#city").prop('required', false);
                    $("#state").prop('required', false);
                    $("#inputPhoneNumber").prop('required', false);

                    modalHeaderValue = "Sign In";
                    $("#userNameRow").hide();
                    $("#phoneRow").hide();
                    $("#cityRow").hide();
                    $("#stateRow").hide();
                    $("#submitButton").html("SignIn");
                    $("#inputPassword").prop('required', true);
                    $("#inputEmail").prop('required', true);
                    submitMode = 1;
                    break;
            }
            $("#modalHeader").html(modalHeaderValue);
            $("#modalDiv").toggle("slow");
            $("#blanket").toggle("slow");
        }

        function getPublicEventsFromDatabase(type) {

            var query = {PAGE:'HOME',COMMAND:'GET_PUBLIC_EVENTS',SELECT_TYPE:type};
            $.ajax({url:'eventController.php',type:'post',data:query,
                    success:function(result){
                        //console.log(result);
                        $("#eventScrollList").html('');
                        $("#eventScrollList").html(result);

                        $(".eventButton").click(function () {
                            showModal("signInAnchor");
                        });

                        $("#eventFilterTitle").html(type+" EVENTS");
                    },
                    fail:function (XMLHttpRequest, textStatus, error) {
                        alert("FAILED");
                    }
            });
        }

        $(document).ready(function () {
            //getDeviceLocation();

            getPublicEventsFromDatabase("ALL");

            <?php
            if (isset($displayModal)) {
                if ($displayModal == 'SIGNIN') {
                    echo 'showModal("signInAnchor");';
                } elseif ($displayModal == 'REGISTER') {
                    echo 'showModal("registerAnchor");';
                } else
                    echo 'hideModal();';
            }
            ?>

            $("#modalForm").on('submit', function () {
                switch (submitMode) {
                    case 1:
                        $("#commandInput").val("SIGNIN");
                        $("#modalForm").submit();
                        checkFormValues();
                        break;
                    case 2:
                        $("#commandInput").val("REGISTER");
                        $("#modalForm").submit();
                        break;
                    default:
                        alert("SSSS");
                        break;
                }
            });

        });

        function search () {
            hideModal();
            var criteria = $("#searchField").val();
            if (criteria.length>0){
                var query = {PAGE:'HOME',COMMAND:'SEARCH',CRITERIA:criteria,SELECT_TYPE:'ALL'};

                $.ajax({url:'eventController.php',type:'post',data:query,
                    success:function(result){
                        $("#eventScrollList").html('');
                        $("#eventScrollList").html(result);

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

        function getDeviceLocation(){
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError);
            } else {
               alert("Geolocation is not supported by this browser.");
            }
        }

        function showPosition(position) {
            alert("Latitude: " + position.coords.latitude +
                "<br>Longitude: " + position.coords.longitude);
        }

        function showError(error) {
            switch(error.code) {
                case error.PERMISSION_DENIED:
                    alert("User denied the request for Geolocation because of HTTP ");
                    break;
                case error.POSITION_UNAVAILABLE:
                    alert("Location information is unavailable.");
                    break;
                case error.TIMEOUT:
                    alert("The request to get user location timed out.");
                    break;
                case error.UNKNOWN_ERROR:
                    alert("An unknown error occurred.");
                    break;
            }
        }



    </script>

</head>

<body>
<nav id="navBar" class="navbar navbar-expand-md navbar-light bg-success fixed-top" style="margin:0">
    <a class="navbar-brand active" href="home.php">EventBook</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#myNavBar">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="myNavBar">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" id="signInAnchor" onclick="showModal(this.id)">Sign In</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="registerAnchor" onclick="showModal(this.id)">Register</a>
            </li>
        </ul>

            <input class="form-control " type="text" placeholder="Search Events" id="searchField" onkeydown="search()"/>
            <button class="btn btn-dark" id="searchButton"type="button" onclick="search()">Search</button>
    </div>
</nav>

<div id="blanket" onclick="hideModal()">
</div>


<div id="postEventOptions">
    <div class="col-sm-8" style="display: inline-block">
        <ul class="nav flex-column" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <li class="nav-item bg-danger text-light"><a class="nav-link" id="list-questions" onclick="showModal()">Post New Event</a></li>
        </ul>
    </div>
    <div class="dropdown">
        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><span id="eventFilterTitle">Filter Event Type</span><span class="caret"></span></button>
        <ul class="dropdown-menu">
            <li class = "nav-link"><a onclick="getPublicEventsFromDatabase(this.name)" name="EDUCATIONAL">Educational</a></li>
            <li class = "nav-link"><a onclick="getPublicEventsFromDatabase(this.name)" name="BUSINESS">Business</a></li>
            <li class = "nav-link"><a onclick="getPublicEventsFromDatabase(this.name)" name="SOCIAL">Social</a></li>
            <li class = "nav-link"><a onclick="getPublicEventsFromDatabase(this.name)" name="PARTY">Party</a></li>
            <li class = "nav-link"><a onclick="getPublicEventsFromDatabase(this.name)" name="SPORTS">Sports</a></li>
            <li class = "nav-link"><a onclick="getPublicEventsFromDatabase(this.name)" name="AWARDS">Awards</a></li>
        </ul>
    </div>

</div>

<!--MODALS-->
<div class="modal" id="modalDiv" role="dialog">

         <div class="modal-dialog modal-dialog-centered" >
        <!-- Modal content-->
        <div class="modal-content" style="overflow-y: auto; max-height: 500px;">
            <div class="modal-header">
                <h4 class="modal-title" id="modalHeader"></h4>
                <button type="button" class="close" onclick="hideModal()">&times;</button>
            </div>
            <div class="modal-body" >
                <?php
                if (!empty($invalidPasswordEmailError)) {
                    echo $invalidPasswordEmailError;
                }
                ?>
                <form id="modalForm" method="post" action="userController.php">

                    <div class="form-group row" id="hiddenInputValues" style="display: none;">
                        <input type="hidden" name="PAGE" value="HOME"/>
                        <input type="hidden" id="commandInput" name="COMMAND" value="SIGNIN"/>
                    </div>
                    <div class="form-group row" id="userNameRow">
                        <label for="inputUserName" class="col-sm-4 col-form-label">Username:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="USERNAME" maxlength="45" id="inputUserName"
                                   placeholder="Name" minlength="5"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail" class="col-sm-4 col-form-label">Email:</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" name="EMAIL" id="inputEmail" placeholder="Email"
                                   required=""/>
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

                    <div class="form-group row" id="phoneRow">
                        <label for="inputPhoneNumber" class="col-sm-4 col-form-label">Phone Number:</label>
                        <div class="col-sm-8">
                            <input type="tel" maxlength="13" class="form-control" name="PHONE_NUMBER"
                                   id="inputPhoneNumber"
                                   pattern="[+]{0,1}[0-9]{10,13}" placeholder="Phone number" minlength="10"
                                   title="Only Numbers allowed"/>
                        </div>
                    </div>

                    <div class="form-group row" id="cityRow" style=" = display: none;">
                        <label for="city" class="col-sm-4 col-form-label">City: </label>
                        <div class="col-sm-8">
                            <input type="text" maxlength="25" class="form-control" name="CITY"
                                   id="city" placeholder="City"/>
                        </div>
                    </div>

                    <div class="form-group row" id="stateRow" style="display: none;">
                        <label for="state" class="col-sm-4 col-form-label">State:</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="STATE" id="state" >
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

                    <div class="modal-footer">
                        <button id="submitButton" type="submit" onclick="$('#modalForm').submit();" class="btn btn-success" value="Submit">Submit</button>
                        <button type="button" class="btn btn-danger" onclick="hideModal()" value="Close">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid jumbotron" id="eventScrollBack">

    <div class="container" id="eventScrollList">


    </div>
</div>

</body>