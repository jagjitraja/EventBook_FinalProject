<?php

/**
 * Created by PhpStorm.
 * User: T00533766
 * Date: 3/22/2018
 * Time: 10:44 AM
 */
//TODO: CONTROL ALSO IF USER COMES BACK WITH SESSION
if (empty($_POST['PAGE'])) {
    include("./home.php");
    $displayModal = 'NO_MODAL';
    exit();
}

require ("./ModelFiles/model.php");

if($_POST['PAGE']=='HOME'){

    $emailEntered = $_POST['EMAIL'];
    $passwordEntered = $_POST['PASSWORD'];


    if($_POST['COMMAND']=='SIGNIN'){

        if(checkEmailPassword($emailEntered,$passwordEntered)){

            //include ();
        }else{
            $displayModal = 'SIGNIN';
            $invalidPasswordEmailError = "<h6 id='error' class = 'alert-danger'>Invalid Email - Password combination entered</h6>";

            include("./home.php");

        }
    }
    elseif ($_POST['COMMAND'] == 'REGISTER'){
        //check validity and sign in

        if(userExistsInDB($emailEntered)){
            //go to home page, show error and prompt to sign in
        }else{
            $username = $_POST['USERNAME'];
            $phone_number = $_POST['PHONE_NUMBER'];

            if (addUserInDB($username,$emailEntered,$passwordEntered,$phone_number)){

            }else{
                $displayModal = 'REGISTER';
                $invalidPasswordEmailError = "<p class = 'alert-danger'>Failed to register, Please try again</p>";

                include("./home.php");
            }
        }
    }

}elseif ($_POST['PAGE']=='MAIN'){

}

?>



