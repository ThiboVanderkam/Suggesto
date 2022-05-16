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
        <link rel="stylesheet" href="assets/css/style.css" type="text/css">

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
            </div>
            <br>
            <div>
                <a href="logout.php" id="">Logout</a>
            </div>

                <a href="#" class="bestFriends"><u>Your Friends</u></a>
                <ul id="friendsList" class="font-body">

                </ul>
        </div>

        <!-- ____________________________HomeDing (hierboven was sidebar)_______________________________ -->
        <div class="main-friends"> <!-- MAIN maken voor de rest van de website buiten de sidebar -->
        <h1 class="border">SUGGESTO</h1>
            
            <div class="header-box">
                <ul>
                    <li><a href="#">Calender</a></li>
                    <li><a href="#">Friends</a></li>
                    <li><a href="#">My profile</a></li>
                </ul>
            </div>

            <div class="sidenav2 border">

                <a href="#" ><u>All Friends</u></a>
                <ul >
                    <li id="friend-list">
                        vriend 1
                    </li>
                    <li>
                        vriend 2
                    </li>
                    <li>
                        vriend 3
                    </li>

                </ul>
            </div>

            <br>

            <div class="header-box2 border">
                <a href="addFriendEmail.php">Add Friend Account</a>
                <a href="addFriendNoAcc.php">Add Friend Without Account</a>
                <a href="editFriendPage.php">Edit Friend</a>

            </div>

            <hr> 
            <br>
            <br>

            <div id="addFriendPage" class="font-body"> <!-- is eig gwn de friendsPage.php -->
                <div class="blueDiv border">
                    <br>
                    <br>
                    <label for="friendNameInput">Friend Name:</label>
                    <br>
                    <input type="text" id="friendNameInput" maxlength = "90" required>

                    <br>
                    <br>
                    <br>

                    <label for="friendEmailInput">Friend e-mailaddress:</label>
                    <br>
                    <input type="email" id="friendEmailInput" maxlength = "90" required>
                    
                    <br>
                    <br>
                    <br>


                    <input type="submit" value="save">
                    <br>
                    <br>
                    <br>
                </div>
            </div>

            <div id="data" style = "display: none">
                <?php
                    echo $user["u_email"];
                ?>
            </div>

    
            
        </div> 
        <script src="assets/js/addFriend.js">
        </script>
    </body>
</html>