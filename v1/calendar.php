<?php
include "assets/db/databaseClass.php";
include "sessionInvalid.php";

$db = new Database();

$userId = $_SESSION['u_id'];

$user = $db->getQuery("SELECT * FROM user WHERE u_id = '$userId';")[0];

$firstname = $user["u_firstname"];
?>

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
                <a href="#" class="">Hello <?php echo $firstname;?></a>
                <a href="logout.php">Logout</a>
            </div>

            <a href="#" class="bestFriends"><u>Your Friends</u></a>
            <ul id="friendsList" class="font-body">
                
            </ul>

        </div>

        <!-- ____________________________HomeDing (hierboven was sidebar)_______________________________ -->
        <div class="main"> <!-- MAIN maken voor de rest van de website buiten de sidebar -->
            <h1 class="border">SUGGESTO</h1>

            <!--                   --     (BORDER WERKT NOG NIET (idk wrm)   --                      -->
            
            <div class="header-box">
                <ul>
                    <li id="calendarButton"><a href="#">Calendar</a></li>
                    <li id="addFriendEmailButton"><a href="#">Friends</a></li>
                    <li id="profileButton"><a href="myProfile.php">My Profile</a></li>
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

        <div id="data" style = "display: none">
            <?php
                echo $user["u_email"];
            ?>
        </div>

        <script src="assets/js/calendar.js">            
        </script>
    </body>
</html>