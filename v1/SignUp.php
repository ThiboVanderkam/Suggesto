<?php

include "assets/db/apiClass.php";
include "sessionValid.php";

$api = new Api();
$db = new Database();

if (isset($_POST["submit"])){
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $bday = $_POST["birthday"];
    $email = $_POST["email"];
    $password = $_POST["password"]; 
    $cpassword = $_POST["cpassword"];
    //de nodige dingen posten om een account aan te maken

    if ($password == $cpassword){        
        //password even checken
        $hash = password_hash($password, PASSWORD_DEFAULT); //hash van de pass maken

        $query = "SELECT * FROM user WHERE u_email ='$email';";
        $result = mysqli_query($db->connection, $query); 
        //dit is om te kijken of er al een account bestaat zoekt eigenlijk gewoon de mail op in de database 
        //als het een hit is dan wilt dat zeggen dat email in use is
        if($result->num_rows > 0){
            echo "<script>alert('Email already in use.')</script>";
        }
        else{
            //als de mail ongebruikt is voegt hij die persoon ineens toe aan de database
            $query = "INSERT INTO `user` (`u_isverified`, `u_firstname`, `u_lastname`, `u_dob`, `u_email`, `u_password`, `u_id`) VALUES ('0', '$name', '$surname', '$bday', '$email', '$hash', NULL);";
            $result = $db->insertQuery($query); //putting the user in the database
            if($result == true){
                // zit in result weer omdat hij moet weten of de query gelukt is
                $userId = $db->getQuery("SELECT u_id FROM user WHERE u_email='$email';")[0]["u_id"];
                $interestsString = "";
                //nu even de interesses van de persoon toevoegen
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
                    $parameters = []; //parameters clearen zodat bij refresh geen dubbele dingen
                }
                else{
                    echo "<b>Please Select Atleast One Option.</b>";
                }
                header("Location: login.php"); //naar login gaan als signup success
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




<!-- Arne Vernaillen  -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sign Up Page</title>
        <link rel="stylesheet" href="/assets/css/signUp.css" type="text/css">

        <!-- fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Italianno&family=Poppins:wght@300&display=swap" rel="stylesheet">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Italianno&family=Poppins:wght@200;300&display=swap" rel="stylesheet">

    </head>
    <body class="body">

        <form method="POST" action="">

            <div class="grotere-box font-body">
                
                <div class="signUp-box">

                    <div id="div1">

                        <!--Name-->
                        <div>
                            <br>
                            <label>Name</label>
                            <br>
                            <input type="text" name="name" id="form-name" maxlength="90" required>
                        </div>

                        <!--Surname-->
                        <div>
                            <br>
                            <label>Surname</label>
                            <br>
                            <input type="text" name="surname" id="form-surname" maxlength="90" required>
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
                            <input type="email" name="email" id="form-email"  maxlength="90" required>
                            <br>
                            <br>
                        </div>

                        <!--Password-->
                        <div>
                            <label>Password</label>
                            <br>
                            <input type="password" name="password" id="form-password" maxlength = "90" required>
                            <br>
                            <br>
                        </div>

                        <!--re-enter Password-->
                        <div>
                            <label>Re- enter Password</label>
                            <br>
                            <input type="password" name="cpassword" id="form-rePassword" maxlength = "90" required>
                            <br>
                            <br>
                        </div>

                    </div>

                    <div id="div3">
                        <h3 id="interests">Interests</h3>
                        <label for="games">Games</label>
                        <input type="checkbox" id="games" name="check_list[]" value="games">
                        <!--                     
                        <label for="books">Books</label>
                        <input type="checkbox" id="books" name="check_list[]" value="books"> -->

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

                    <div id="div6">

                        <!--Submit button-->
                        <div>
                            <input class="signUpButton" type="submit" name="submit" value="Sign Up">
                        </div>
        
                        <div>    
                        <p>Already have an account? <a href= "/login.php" class="link">LOGIN HERE</a></p>
        
                        </div>

                    </div>
    
                </div> <!--End of loginbox div-->  

            </div>
               
                
        </form>

        
	
    </body>
</html>