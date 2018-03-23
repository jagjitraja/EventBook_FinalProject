<?php
/**
 * Created by PhpStorm.
 * User: T00533766
 * Date: 3/22/2018
 * Time: 10:44 AM
 */
//TODO: CONTROL ALSO IF USER COMES BACK WITH SESSION
if (empty($_POST['PAGE'])) {
    include("home.php");
    exit();
}

require ("./ModelFiles/model.php");

if($_POST['PAGE']=='HOME'){

    $emailEntered = $_POST['EMAIL'];
    $passwordEntered = $_POST['PASSWORD'];


    if($_POST['COMMAND']=='SIGNIN'){

        if(userExistsInDB($emailEntered)){
            //go to signed in page
        }else{
            //go back to home page and show error
        }
    }
    elseif ($_POST['COMMAND'] == 'REGISTER'){
        //check validity and sign in

        if(userExistsInDB($emailEntered)){
            //go to home page, show error and prompt to sign in
        }else{
            $username = $_POST['USERNAME'];
            $phone_number = $_POST['PHONE_NUMBER'];

            addUserInDB($username,$emailEntered,$passwordEntered,$phone_number);

        }

    }



}elseif ($_POST['PAGE']=='MAIN'){

}

?>



