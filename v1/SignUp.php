<?php

include "assets/db/databaseClass.php";
include "sessionValid.php";

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
        $result = mysqli_query($db->connection, $query);
        if($result->num_rows > 0){
            echo "<script>alert('Email already in use.')</script>";
        }
        else{    
            $query = "INSERT INTO `user` (`u_isverified`, `u_firstname`, `u_lastname`, `u_dob`, `u_email`, `u_password`, `u_id`) VALUES ('1', '$name', '$surname', '$bday', '$email', '$hash', NULL);";
            $result = $db->insertQuery($query); //putting the things in the database
            if($result == true){
                $name = "";
                $surname = "";
                $bday = "";
                $email = "";
                $_POST["password"];
                $_POST["cpassword"];
                echo "<script>alert('Sign up success.')</script>";
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




<!-- Arne Vernaillen -->
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

            <div class="grotere-box">
                
                <div class="signUp-box">

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
                        <div id="div4">
                            <input type="checkbox" name="games" value="games" id="form-games" >
                            <label for="form-games">Games</label>
                            <br>
                            <input type="checkbox" name="books" value="books" id="form-books" >
                            <label for="form-books">Books</label>
                            <br>
                            <input type="checkbox" name="tech" value="tech" id="form-tech" >
                            <label for="form-tech">Tech</label>
                            <br>
                            <input type="checkbox" name="sports" value="sports" id="form-sports" >
                            <label for="form-sports">Sports</label>
                        </div>

                        <div id="div5">
                            <input type="checkbox" name="beauty" value="beauty" id="form-beauty" >
                            <label for="form-beauty">Beauty</label>
                            <br>
                            <input type="checkbox" name="nature" value="nature" id="form-nature" >
                            <label for="form-nature">Nature</label>
                            <br>
                            <input type="checkbox" name="photography" value="photography" id="form-photography" >
                            <label for="form-photography">Photography</label>
                            <br>
                            <input type="checkbox" name="other" value="other" id="form-other" >
                            <label for="form-other">Other...</label>      
                        </div>

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