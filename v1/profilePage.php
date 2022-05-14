<!--PHP to display user info -->
<?php
    include "sessionInvalid.php";
    include "assets/db/databaseClass.php";

    $db = new Database();
    $userId = $_SESSION['u_id'];
    $user = $db->getQuery("SELECT * FROM user WHERE u_id = '$userId';")[0];
    $firstname = $user["u_firstname"];
    $lastname = $user["u_lastname"];
    $email = $user["u_email"];
    $password = $user["u_password"];

    //PHP to edit info on the database


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Profile Page</title>
        <link rel="stylesheet" href="/assets/css/profilePage.css" type="text/css">
        <link rel="stylesheet" href="/assets/css/modal.css" type="text/css">

        <!-- fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Italianno&family=Poppins:wght@300&display=swap" rel="stylesheet">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Italianno&family=Poppins:wght@200;300&display=swap" rel="stylesheet">

    </head>
    <body class="body">

   
        
        <div class="side-box">

            <div>
                <a href="profilePage.php" ><u>My account</u></a>
                <br>
                <br>
                <a href="giftPreferences.php" ><u>My gift preferences</u></a>
                <br>
                
                <br>    
                <a href="adminCreateUserPage.php" ><u>Admin Controls</u></a>
                
            </div>

            <div>
                <button type="button" id="logout-button">Logout</button>
            </div>

        </div>

        <div class="grotere-box">
                
            <div class="login-box">

                <p id="name"><?php echo $firstname;?></p>

                <div class="inner-box">

                    <div class="div1">
                        <p id="first">Username:</p>
                        <p id="second"><?php echo $firstname;?></p>
                        
                        <p id="first">E-mail address:</p>
                        <p id="second"><?php echo $email;?></p>

                        <p id="first">Password:</p>
                        <p id="second">********</p>
                         <!--<p id="second"><?php echo $password;?></p>-->
    <!--
                        <p id="first">Phone Number:</p>
                        <p id="second">04 685 45 71</p>
    -->
                    </div>

                    <div class="div2">
                        <button id="usernameButton">Edit</button>
                        <br>
                        <br>
                        <button id="emailButton">Edit</button>
                        <br>
                        <br>
                        <button id="passwordButton">Edit</button>
                        <br><!--
                        <br>
                        <button type="button" id="edit-button">Edit</button>-->
                    </div>

                </div><!--End of innerbox div-->  

            </div> <!--End of loginbox div-->  

        </div><!--End of grotere box div-->  

        <!-- The Modal for username-->
        <div id="u_Modal" class="modal">

            <!-- Modal content username-->
            <div class="modal-content">
                <span class="closeU">&times;</span>
                <p>Write your new username here:</p>
                <input type="text" name="username" id="modal-username">
                <br>
                <br>
                <button id="Modal1ContentButton">Save Changes</button>
            </div>
        </div>

        <!-- The Modal for email-->
        <div id="e_Modal" class="modal">

            <!-- Modal content email-->
            <div class="modal-content">
                <span class="closeE">&times;</span>
                <p>Write your new email here:</p>
                <input type="text" name="email" id="modal-email">
                <br>
                <br>
                <button id="Modal2ContentButton">Save Changes</button>

            </div>

        </div>

        <!-- The Modal for password-->
        <div id="p_Modal" class="modal">

            <!-- Modal content password-->
            <div class="modal-content">
                <span class="closeP">&times;</span>
                <p>Write your new password here:</p>
                <input type="text" name="password" id="modal-password">
                <br>
                <br>
                <button id="Modal3ContentButton">Save Changes</button>

            </div>
        </div>
        
        <!--Script modal username-->
        <script>
        // Get the modal
        var modal = document.getElementById("u_Modal");

        // Get the button that opens the modal  
        var btn = document.getElementById("usernameButton");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("closeU")[0];

        // When the user clicks on the button, open the modal
        btn.onclick = function() {
        modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
        modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
        </script>

        <!--Script modal email-->
        <script>
        // Get the modal
        var modal = document.getElementById("e_Modal");

        // Get the button that opens the modal  
        var btn = document.getElementById("emailButton");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("closeE")[0];

        // When the user clicks on the button, open the modal
        btn.onclick = function() {
        modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
        modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
        </script>

        <!--Script modal password-->
        <script>
        // Get the modal
        var modal = document.getElementById("p_Modal");

        // Get the button that opens the modal  
        var btn = document.getElementById("passwordButton");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("closeP")[0];

        // When the user clicks on the button, open the modal
        btn.onclick = function() {
        modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
        modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
        </script>
	
    </body>

</html>