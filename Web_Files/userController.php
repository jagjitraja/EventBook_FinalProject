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


    if($_POST['COMMAND']=='SIGNIN'){
        $emailEntered = $_POST['EMAIL'];
        $passwordEntered = $_POST['PASSWORD'];

        if(checkEmailPassword($emailEntered,$passwordEntered)){
            session_start();
            $_SESSION['userEmail'] = $emailEntered;
            $_SESSION['LOGGED_IN'] = 'YES';
            setcookie("email",$emailEntered,time()+86400);
            include ("./logged_in.php");
            $userData = getUserData($emailEntered,$passwordEntered);
            $_SESSION['USER_INFO'] = $userData;
        }else{
            $displayModal = 'SIGNIN';
            $invalidPasswordEmailError = "<h6 id='error' class = 'alert-danger'>Invalid Email - Password combination entered</h6>";
            include("./home.php");
            exit();
        }
    }
    elseif ($_POST['COMMAND'] == 'REGISTER'){
        //check validity and sign in
        $username = $_POST['USERNAME'];
        $phone_number = $_POST['PHONE_NUMBER'];
        $user_city = $_POST['CITY'];
        $user_state = $_POST['STATE'];
        $emailEntered = $_POST['EMAIL'];
        $passwordEntered = $_POST['PASSWORD'];

        if(userExistsInDB($emailEntered)){
            $displayModal = 'SIGNIN';
            $invalidPasswordEmailError = "<h6 class = 'alert-danger'>Email exists, try signing in</h6>";
            include("./home.php");

        }elseif (addUserInDB($username,$emailEntered,$passwordEntered,$phone_number,$user_city,$user_state)){
            session_start();
            $_SESSION['user'] = $emailEntered;
            $_SESSION['LOGGED_IN'] = 'YES';
            setcookie("email",$emailEntered,time()+86400);
            $userData = getUserData($emailEntered,$passwordEntered);
            $_SESSION['USER_INFO'] = $userData;
            include ("./logged_in.php");
        }else{
            $displayModal = 'REGISTER';
            $invalidPasswordEmailError = "<h6 class = 'alert-danger'>Failed to register, Please try again</h6>";
            include("./home.php");
        }
    }

}elseif ($_POST['PAGE']=='LOGGED_IN'){

    session_start();

    $command = $_POST['COMMAND'];

    if (!isset($_SESSION['LOGGED_IN']) || $_SESSION['LOGGED_IN'] != 'YES') {
        echo 'Session is broken<br>';
        session_unset();
        session_destroy();
        exit();
    }
    switch ($command){
        case 'SIGN_OUT':
            signOut();
            break;
        default:
            echo "AN ERROR OCCURED";
            break;
    }

}else{
    echo "An error occured";
    signOut();
    include "home.php";
}


function signOut(){
    session_unset();
    session_destroy();
    include "home.php";
}

?>



