<!DOCTYPE HTML>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="homeStyles.css"/>
    <script>

        //is submitMode ==1, then user is signing in else if submitMode==2 user is registering;
        submitMode = 1;

        function hideModal() {
            $("#blanket").hide("slow");
            $("#modalDiv").hide("slow");
        }

        function showModal(e) {
            var modalHeaderValue = "";
            switch (e) {
                case "signInAnchor":
                    modalHeaderValue = "Sign In";
                    $("#userNameRow").hide();
                    $("#phoneRow").hide();
                    $("#submitButton").html("SignIn");
                    $("#inputPassword").prop('required', true);
                    $("#inputEmail").prop('required', true);
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
                    submitMode = 2;
                    break;

                default:
                    hideModal();
            }
            $("#modalHeader").html(modalHeaderValue);
            $("#modalDiv").toggle("slow");
            $("#blanket").toggle("slow");
        }

    $("#modalForm").on('submit',function(){

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

    </script>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="margin:0">
    <a class="navbar-brand" href="./home.php">EventBook</a>
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
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="text" placeholder="Search Events">
            <button class="btn btn-success my-2 my-sm-0" type="button">Search</button>
        </form>
    </div>

</nav>

<div id="blanket" onclick="hideModal()">
</div>
<!--MODALS-->
<div class="modal" id="modalDiv" role="dialog">

    <div class="modal-dialog modal-dialog-centered">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalHeader"></h4>
                <button type="button" class="close" onclick="hideModal()">&times;</button>
            </div>
            <div class="modal-body">
                <form id="modalForm" method="post" action="./userController.php">

                    <div class="form-group row" id="hiddenInputValues" style="display: none;">
                        <input type="hidden" name="PAGE" value="HOME"/>
                        <input type="hidden" id="commandInput" name="COMMAND" value="SIGNIN"/>
                    </div>
                    <div class="form-group row" id="userNameRow">
                        <label for="inputUserName" class="col-sm-3 col-form-label">Username:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="USERNAME" maxlength="45" id="inputUserName"
                                   placeholder="Name" minlength="5"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="EMAIL" class="col-sm-3 col-form-label">Email:</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" name="EMAIL" id="inputEmail" placeholder="Email"  required="" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-3 col-form-label">Password:</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" name="PASSWORD" id="inputPassword"
                                   placeholder="Password" minlength="8" maxlength="30"
                                   pattern="([0-9]+).{0,}([a-z]+).{0,}([A-Z])+" required="" />
                        </div>
                    </div>
                    <div class="form-group row" id="phoneRow">
                        <label for="inputPhoneNumber" class="col-sm-3 col-form-label">Phone Number:</label>
                        <div class="col-sm-9">
                            <input type="tel" maxlength="13" class="form-control" name="PHONE_NUMBER"
                                   id="inputPhoneNumber" placeholder="Phone number" minlength="10"/>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button id="submitButton" type="submit" class="btn btn-success" value="Submit">Submit</button>
                        <button type="button" class="btn btn-danger" onclick="hideModal()" value="Close">Close</button>
                    </div>
                </form>


            </div>
        </div>
    </div>
</div>
</body>