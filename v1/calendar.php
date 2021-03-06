<?php
include "assets/db/databaseClass.php";
include "sessionInvalid.php";

$db = new Database();

$userId = $_SESSION['u_id'];

$user = $db->getQuery("SELECT * FROM user WHERE u_id = '$userId';")[0];

$firstname = $user["u_firstname"];

if(isset($_POST["submit"])){
    $friendId = $_POST["friendId"];
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>📆Your Calendar📆</title>
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
            <div id="">
                <a href="myProfile.php">Hello <?php echo $firstname;?></a>
            </div>
            <br>
            <div>
                <a href="logout.php" id="">Logout</a>
            </div>
            <div id="friendsNames">
                <a href="addFriendEmail.php" ><u>Your Friends</u></a>
                <ul id="friendsList" class="font-body">

                </ul>
            </div>

            <div id="calendarFriends">
                <p>Click on your friends bday to see their gifts!</p>
                <ul id="dateList" class="font-body">

                </ul>
            </div>

            <div id="friendsLinks">

            </div>
        </div>

        <!-- ____________________________HomeDing (hierboven was sidebar)_______________________________ -->
        <div class="main"> <!-- MAIN maken voor de rest van de website buiten de sidebar -->
            <h1 class="border">SUGGESTO</h1>
            
            <div class="header-box">
                <ul>
                    <li id="calendarButton"><a href="calendar.php">Calendar</a></li>
                    <li id="addFriendEmailButton"><a href="addFriendEmail.php">Friends</a></li>
                    <li id="profileButton"><a href="myProfile.php">My Profile</a></li>
                    <!-- <li id=""><a href="myPreferences.php">For Me-Page</a></li> -->
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