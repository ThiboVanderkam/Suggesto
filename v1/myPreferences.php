<?php
    include "sessionInvalid.php";
    include "assets/db/databaseClass.php";

    $db = new Database();
    $userId = $_SESSION['u_id'];
    $user = $db->getQuery("SELECT * FROM user WHERE u_id = '$userId';")[0];
    $firstname = $user["u_firstname"];
    $lastname = $user["u_lastname"];
    $dob = $user["u_dob"];

    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="assets/css/myProfile.css" type="text/css">

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
                <a href="#" id="">Hello <?php echo $firstname;?></a>

                <a href="logout.php" id="">Logout</a>
            </div>

            <a href="#" class="bestFriends"><u>Your Friends</u></a>
            <ul id="friendsList" class="font-body">
                
            </ul>
        </div>

        <!-- __________________________________________Sidebar___________________________________________ -->
        

        <!-- ____________________________HomeDing (hierboven was sidebar)_______________________________ -->
        <div class="main"> <!-- MAIN maken voor de rest van de website buiten de sidebar -->
            <h1 class="border">SUGGESTO</h1>
            
            <div class="header-box">
                <ul>
                    <li id="calendarButton"><a href="calendar.php">Calendar</a></li>
                    <li id="addFriendEmailButton"><a href="addFriendEmail.php">Friends</a></li>
                    <li id="profileButton"><a href="myProfile.php">My Profile</a></li>
                </ul>
            </div>

            <div id="ForMe-div">
                <h1><u>For me:</u></h1>
                <br>

                <div class="font-body">product soort 1</div>
                <div class="suggestion-div">
                    <div class="box"></div>
                    <div class="box"></div>
                    <div class="box"></div>
                    <div class="box"></div>
                </div>

                <div class="font-body">product soort 2</div>
                <div class="suggestion-div">
                    <div class="box"></div>
                    <div class="box"></div>
                    <div class="box"></div>
                    <div class="box"></div>
                </div>

                <div class="font-body">product soort 3</div>
                <div class="suggestion-div">
                    <div class="box"></div>
                    <div class="box"></div>
                    <div class="box"></div>
                    <div class="box"></div>
                </div>
            </div>

        </div>

        <div id="data" style = "display: none">
            <?php
                echo $user["u_email"];
            ?>
        </div>
    <script src="assets/js/myPreferences.js">
    </script>
</html>