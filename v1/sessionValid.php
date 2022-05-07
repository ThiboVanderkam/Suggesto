<?php
/*Starting the session*/
session_start();

if(isset($_SESSION['u_id'])){ 
    //als session al gestart (dus successvol ingelogd) is redirecten naar calendar
    header("Location: calendar.php");
}
?>