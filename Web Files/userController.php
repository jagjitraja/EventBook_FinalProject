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

if($_POST['PAGE']=='HOME'){

    if($_POST['COMMAND']=='SIGNIN'){

        //check validity
    }
    elseif ($_POST['COMMAND'] == 'REGISTER'){
        //check validity and sign in
    }



}elseif ($_POST['PAGE']=='MAIN'){

}

?>



