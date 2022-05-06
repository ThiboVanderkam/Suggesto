<?php
/*Starting the session*/
session_start();

/*if the user is already logged in redirect him to the welcome page*/
if (isset($_SESSION["userid"]) && $_SESSION["userid"] === true){ //=== => same info and datatype
    header("location: calendar.php");
    exit; //terminates execution of a script
}