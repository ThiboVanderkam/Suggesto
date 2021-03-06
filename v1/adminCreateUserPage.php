<?php

include "assets/db/apiClass.php";

$api = new Api();
$db = new Database();

if (isset($_POST["submit"])){
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $bday = $_POST["birthday"];
    $email = $_POST["email"];
    $password = $_POST["password"]; 
    $cpassword = $_POST["cpassword"];
    //moet nog interests bij maken

    if ($password == $cpassword){        
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $query = "SELECT * FROM user WHERE u_email ='$email';";
        $result = $db->getQuery($query);
        if($result->num_rows > 0){
            echo "<script>alert('Email already in use.')</script>";
        }
        else{    
            $query = "INSERT INTO `user` (`u_isverified`, `u_firstname`, `u_lastname`, `u_dob`, `u_email`, `u_password`, `u_id`) VALUES ('1', '$name', '$surname', '$bday', '$email', '$hash', NULL);";
            $result = $db->insertQuery($query); //putting the user in the database
            if($result == true){
                $userId = $db->getQuery("SELECT u_id FROM user WHERE u_email='$email';")[0]["u_id"];
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
                        "interests" => $interestsString
                    ];
                    $api->storeUserInterests($parameters);
                    $parameters = [];
                }
                else{
                    echo "<b>Please Select Atleast One Option.</b>";
                }
                $name = "";
                $surname = "";
                $bday = "";
                $email = "";
                $_POST["password"];
                $_POST["cpassword"];
                echo "<script>alert('You succesfully created an account.')</script>";
                }
                else{
                    echo "<script>alert('Something went wrong.')</script>";
                }
            }
            
    }          
    else{
        echo "<script>alert('Passwords do not match.')</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Page</title>
        <link rel="stylesheet" href="/assets/css/adminCreateUserPage.css" type="text/css">

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
                <a href="logout.php" id="logout-button">Logout</a>
            </div>

        </div>

        <form method="POST" action="">


            <div class="grotere-box">
                    
                <div class="admin-box">

                    <div class="upper-box">

                        <div class="button-div">

                            <div class="buttons">
                                <a href='adminCreateUserPage.php'>
                                    <button type="button" id="cu-button">Create User</button>
                                </a>
                            </div>

                            <div class="buttons">
                                <a href='adminDeleteUserPage.php'>
                                    <button type="button" id="du-button">Delete User</button>
                                </a>
                            </div>

                            <div class="buttons">
                                <a href='adminEditUserPage.php'>
                                    <button type="button" id="eu-button">Edit User</button>
                                </a>
                            </div>

                        </div>

                        <div id="textUpper">
                            <p>Make a new user account. This can be linked to a real person who might have difficulties creating their account or it can be a fake account used for testing.</p>
                        </div>
                    
                    </div> <!--End of upperbox div-->

                    <div class="main-box">

                        <div id="div1">

                            <!--Name-->
                            <div>
                                <br>
                                <label>Name</label>
                                <br>
                                <input type="text" name="name" id="form-name" required>
                            </div>

                            <!--Surname-->
                            <div>
                                <br>
                                <label>Surname</label>
                                <br>
                                <input type="text" name="surname" id="form-surname" required>
                                <br>
                            </div>

                            <!--Birthday-->
                            <div>
                                <br>
                                <label>Birthday</label>
                                <br>
                                <input type="date" name="birthday" id="form-birthday" required>
                                <br>
                                <br>
                            </div>

                        </div>

                        <div id="div2">

                            <!--e-mail-->
                            <div>
                                <br>
                                <label>E-mail</label>
                                <br>
                                <input type="text" name="email" id="form-email"required>
                                <br>
                                <br>
                            </div>

                            <!--Password-->
                            <div>
                                <label>Password</label>
                                <br>
                                <input type="password" name="password" id="form-password" required>
                                <br>
                                <br>
                            </div>

                            <!--re-enter Password-->
                            <div>
                                <label>Re- enter Password</label>
                                <br>
                                <input type="password" name="cpassword" id="form-rePassword"required>
                                <br>
                                <br>
                            </div>

                        </div>

                        <div id="div3">
                            <h3 id="interests">Interests</h3>
                                <label for="games">Games</label>
                                <input type="checkbox" id="games" name="check_list[]" value="games">
                            
                                <label for="books">Books</label>
                                <input type="checkbox" id="books" name="check_list[]" value="books">

                                <br>

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

                            </div>
                        </div>

                        <div id="div6">

                            <!--Submit button-->
                            <div>
                                <input class="signUpButton" type="submit" name="submit" value="Create User">
                            </div>

                        </div>                
                    
                    </div><!--End of mainbox div--> 

                </div> <!--End of adminbox div-->  

            </div><!--End of grotere box div-->  
        </form>
               
    </body>
</html>