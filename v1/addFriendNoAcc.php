<?php
include "assets/db/apiClass.php";
include "sessionInvalid.php";

$db = new Database();
$api = new Api();

$userId = $_SESSION['u_id'];

$user = $db->getQuery("SELECT * FROM user WHERE u_id = '$userId';")[0];

$firstname = $user["u_firstname"];

if (isset($_POST["submit"])){
    $interestsString = "";
    if(!empty($_POST['check_list'])) {
        // Counting number of checked checkboxes.
        $checked_count = count($_POST['check_list']);        
        // Loop to store values of individual checked checkbox.
        foreach($_POST['check_list'] as $selected) {
            $interestsString .= $selected.",";
        }        
        $parameters = [
            "u_id" => $userId,
            "firstname" => $_POST["firstname"],
            "lastname" => $_POST["lastname"],
            "birthday" => $_POST["birthday"],
            "interests" => $interestsString
        ];
        $api->addLocalFriend($parameters);
        $result = $api->storeLocalInterests($parameters);
        if ($result){
            echo "<script>alert('Friend added.')</script>";
            $parameters = [];
        }
        else{
            echo "<script>alert('Something went wrong.')</script>";
        }
    }
    else{
        echo "<b>Please Select Atleast One Option.</b>";
    }
}

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>🧍AddFriendNoAcc🧍</title>
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

            <form action="" method="POST" id="addFriendPage" class="font-body"> <!-- is eig gwn de friendsPage.php -->
                <div class="blueDiv border">
                <br>
                    <label for="addFriendFirstnameIput">Friend FirstName:</label>
                    <br>
                    <input type="text" name="firstname" id="addFriendNameInput" maxlength = "90" required>

                    <br>
                    <label for="addFriendLastnameIput">Friend LastName:</label>
                    <br>
                    <input type="text" name="lastname" id="addFriendNameInput" maxlength = "90" required>

                    <br>
                    <label for="addFriendBrithdayInput">Friend BirthDay:</label>
                    <br>
                    <input type="date" name="birthday" id="addFriendBrithdayInput" required>
                    
                    <br>
                    <br>
                    <u>Interests:</u>
                    <br>
                    <div id="interestsDiv">
                        <label for="nature">Nature</label>
                        <input type="checkbox" id="nature" name="check_list[]" value="nature">

                        <label for="tech">Tech</label>
                        <input type="checkbox" id="tech" name="check_list[]" value="tech">
                        
                        <br>
                        
                        <label for="sports">Sports</label>
                        <input type="checkbox" id="sports" name="check_list[]" value="sports">
                        
                        <label for="photo">Photo</label>
                        <input type="checkbox" id="photo" name="check_list[]" value="photo">

                        <br>
                        
                        <label for="drawing">Drawing</label>
                        <input type="checkbox" id="drawing" name="check_list[]" value="drawing">
                        
                        <label for="beauty">Beauty</label>
                        <input type="checkbox" id="beauty" name="check_list[]" value="beauty">

                        <br>

                        <label for="games">Games</label>
                        <input type="checkbox" id="games" name="check_list[]" value="video games">                        
                    </div>

                    <br>

                    <input type="submit" name="submit" value="Add Friend">
                
                    <div id="data" style = "display: none">
                        <?php
                            echo $user["u_email"];
                        ?>
                    </div>
                   
                </div>
            </form>
        </div> 
        
        <script src="assets/js/addFriend.js">
        </script>
    </body>
</html>