<?php
include "assets/db/apiClass.php";
include "sessionInvalid.php";

$db = new Database();

$userId = $_SESSION['u_id'];

$user = $db->getQuery("SELECT * FROM user WHERE u_id = '$userId';")[0];

$firstname = $user["u_firstname"];

$api = new Api();
if (isset($_POST["submitEmail"])){
    $parameters = [
        "call" => "addFriendEmail",
        "friendEmail" => $_POST["friendEmail"],
        "u_id" => $userId
    ];
    $result = $api->addFriendEmail($parameters);
    $parameters = [];
    if ($result){
        echo "<script>alert('Friend added successfully.')</script>";
    }
    else{
        echo "<script>alert('Something went wrong.')</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>🧍addFriendEmail🧍</title>
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
        <div class="main-friends">
            <h1 class="border">SUGGESTO</h1>
            
            <div class="header-box">
                <ul>
                    <li><a href="calendar.php">Calender</a></li>
                    <li><a href="addFriendEmail.php">Friends</a></li>
                    <li><a href="myProfile.php">My profile</a></li>
                </ul>
            </div>


            <br>

            <div class="header-box2 border">
                <a href="addFriendEmail.php">Add Friend Account</a>
                <a href="addFriendNoAcc.php">Add Friend Without Account</a>

            </div>

            <hr> 
            <br>
            <br>

            <div id="addFriendPage" class="font-body"> <!-- is eig gwn de friendsPage.php -->
                <div class="blueDiv border">
                    <form method="POST" action="">
                        <label for="friendEmail">Friend e-mail:</label>
                        <br>
                        <input type="email" name="friendEmail" id="friendEmail" maxlength = "90" required>
                        <input type="submit" name="submitEmail" value="Add Friend">
                    </form>
                </div>
            </div>

            <div id="data" style = "display: none" name="submit">
                <?php
                    echo $user["u_email"];
                ?>
            </div>
        </div>
            
        <script src="assets/js/addFriend.js">
        </script>
    </body>
</html>