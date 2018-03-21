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

        function hideModal() {
            $("#modal_sign_in_register_blanket").hide();
        }

        function showModal(e) {

            var modalHeader = "";
            var modalDescription = "";


            switch (e) {
                case "signInAnchor":
                    modalHeader = "Sign In";
                    modalDescription = "Sign In to post events or sign up to events";
                    break;

                case "registerAnchor":
                    modalHeader = "Register";
                    modalDescription = "Register to post events or sign up to events";
                    break;
                default:
                    hideModal();
            }

            $("#modal_sign_in_register_blanket").toggle();
            $('#modal_sign_in_register_blanket').animate({opacity: 1},300);
        }

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

    <!--MODALS-->
    <div class="modal fade" id="modal_sign_in_register_blanket" role="dialog" onclick="hideModal()">

        <div id ="modal_div" class="modal-dialog modal-dialog-centered">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Modal Header</h4>
                    <button type="button" class="close" onclick="hideModal()">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Some text in the modal.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" onclick="hideModal()">Close</button>
                </div>
            </div>
        </div>
    </div>
</body>