<?php
include "assets/db/apiClass.php";
include "sessionInvalid.php";

$db = new Database();
$api = new Api();

$userId = $_SESSION['u_id'];

$user = $db->getQuery("SELECT * FROM user WHERE u_id = '$userId';")[0];

$firstname = $user["u_firstname"];

if (isset($_POST["submit"])){
    $parameters = [
        "u_id" => $userId,
        "firstname" => $_POST["firstname"],
        "lastname" => $_POST["lastname"],
        "birthday" => $_POST["birthday"]
    ];
    $result = $api->addLocalFriend($parameters);
    $parameters = [];
    if($result){
        echo "<script>alert('Friend Failed.')</script>";
    }
}

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
                <a href="#" class="">Hello <?php echo $firstname?></a>
                <!-- hier nog naam en foto poppen van de user -->
            </div>

            <a href="#" class="bestFriends"><u>Your Friends</u></a>
            <ul>
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
            
            <a href="#" class="bestFriends"><u>Upcomming events</u></a>

            <button type="radio">ding1</button>
            <br>
            <br>
            <button type="radio">ding2</button>
            <br>
            <br>
            <button type="radio">ding3</button>
            <br>
            <br>
            <button type="radio">ding4</button>
            
        </div>

        <!-- ____________________________HomeDing (hierboven was sidebar)_______________________________ -->
        <div class="main-friends"> <!-- MAIN maken voor de rest van de website buiten de sidebar -->
        <h1 class="border">SUGGESTO</h1>
            
            <div class="header-box">
                <ul>
                    <li><a href="calendar.php">Calender</a></li>
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
                <!-- <ul>
                    <li><a href="#">Add Friend Account</a></li>
                    <li><a href="#">Add friend without account</a></li>
                    <li><a href="#">Edit Friend</a></li>
                </ul> -->
            </div>

            <hr> 
            <br>
            <br>

            <form action="" method="POST" id="addFriendPage" class="font-body"> <!-- is eig gwn de friendsPage.php -->
                <div class="blueDiv border">
                <br>
                    <label for="addFriendFirstnameIput">Friend Name:</label>
                    <br>
                    <input type="text" name="firstname" id="addFriendNameInput">

                    <br>
                    <label for="addFriendLastnameIput">Friend Name:</label>
                    <br>
                    <input type="text" name="lastname" id="addFriendNameInput">

                    <br>
                    <label for="addFriendBrithdayInput">Friend BirthDay:</label>
                    <br>
                    <input type="date" name="birthday" id="addFriendBrithdayInput">
                    
                    <br>
                    Interests:
                    <div id="interestsDiv">
                        <label for="games">Games</label>
                        <input type="checkbox" id="games" name="games">
                    
                        <label for="books">Books</label>
                        <input type="checkbox" id="books" name="books">

                        <br>

                        <label for="nature">Nature</label>
                        <input type="checkbox" id="nature" name="nature">

                        <label for="tech">Tech</label>
                        <input type="checkbox" id="tech" name="tech">
                        
                        <br>
                        
                        <label for="sports">Sports</label>
                        <input type="checkbox" id="sports" name="sports">
                        
                        <label for="photo">Photo</label>
                        <input type="checkbox" id="photo" name="photo">

                        <br>
                        
                        <label for="drawing">Drawing</label>
                        <input type="checkbox" id="drawing" name="drawing">
                        
                        <label for="beauty">Beauty</label>
                        <input type="checkbox" id="beauty" name="beauty">
                        
                    </div>

                    <br>
                    <label for="addToFavoriteCheckBox">Add To Favorite:</label>
                    <input type="checkbox" id="addToFavoriteCheckBox">

                    <br>

                    <input type="submit" name="submit" value="Add">
                
                   
                </div>
            </form>
        </div> 
        
        <script src="assets/js/script.js">
        </script>
    </body>
</html>