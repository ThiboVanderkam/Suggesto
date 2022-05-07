<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Your Calendar</title>
        <link rel="stylesheet" href="assets/css/styleCalendar.css" type="text/css">

        <!-- fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Italianno&family=Poppins:wght@300&display=swap" rel="stylesheet">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Italianno&family=Poppins:wght@200;300&display=swap" rel="stylesheet">
    </head>
    <body>
        <!-- __________________________________________Sidebar___________________________________________ -->
        <div class="sidenav border">
            <div class="flex">
                <a href="#" class="">Hello ...<?php #get name of user ?></a>
            </div>

            <a href="#" class="bestFriends"><u>Friends</u></a>
            
            <p class="font-body">It looks like you haven't chosen your best freinds yet.</p>
            <!-- <a href="#">Clients</a>
            <a href="#">Contact</a> -->

            <!-- <div class="suggestion-div">
                <div class="lilbox">test</div>
                <div class="lilbox">test</div>
            </div>

            <div class="suggestion-div">
                <div class="lilbox">test</div>
                <div class="lilbox">test</div>
            </div>
            <div class="suggestion-div">
                <div class="lilbox">test</div>
                <div class="lilbox">test</div>
            </div> -->
        </div>

        <!-- ____________________________HomeDing (hierboven was sidebar)_______________________________ -->
        <div class="main"> <!-- MAIN maken voor de rest van de website buiten de sidebar -->
            <h1 class="border">SUGGESTO</h1>
            
            <div class="header-box">
                <ul>
                    <li id="calendarButton"><a href="#">Calendar</a></li>
                    <li id="addFriendEmailButton"><a href="#">Friends</a></li>
                    <li id="profileButton"><a href="#">My Profile</a></li>
                </ul>
            </div>

            <br>
        
            <div>
                <?php
                    include "assets/classes/calendarClass.php";
                    $calendar = new Calendar();
                    echo $calendar->show();
                ?>
            </div>
        </div>


        <script src="assets/js/calendar.js">
        </script>
    </body>
</html>