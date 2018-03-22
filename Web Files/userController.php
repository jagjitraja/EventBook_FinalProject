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

        foreach ($_POST as $c => $d){
            echo "KEY ".$c."   Value ".$d;
        }
    }


}elseif ($_POST['PAGE']=='MAIN'){

}

?>



