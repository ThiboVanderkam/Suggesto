<?php

include "assets/db/databaseClass.php";
include "sessionValid.php";

$db = new Database();

if (isset($_POST["submit"])){
    $email = $_POST["email"];
    $password = $_POST["password"];

    $query = "SELECT * FROM user WHERE u_email = '$email';";
    $result = mysqli_query($db->connection, $query);
    $response = mysqli_fetch_assoc($result);
    $passVerify = password_verify($password, $response['u_password']);
    if($result->num_rows > 0 && $passVerify){
        $_SESSION['u_id'] = $response['u_id'];
        header("Location: calendar.php");
    }
    else{
        echo "<script>alert('Email or password is incorrect.')</script>";
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
        <title>Login Page</title>
        <link rel="stylesheet" href="/assets/css/login.css" type="text/css">

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

                <div class="avatar-box">

                </div>
                
                <div class="login-box">
                    <h1>Suggesto</h1>

                    <div id="div1">

                        <!--Email-->
                        <div>
                            <br>
                            <label>E-mail address</label>
                            <br>
                            <input type="email" placeholder="E-mail" name="email"  id="form-email" maxlength = "90" required>
                            <br>
                            <br>
                        </div>

                        <!--Password-->
                        <div>
                            <label>Password</label>
                            <br>
                            <input type="password" placeholder="Password" name="password" id="form-password" maxlength="90" required>
                            <br>
                            <br>
                        </div>

                    </div>

                    <!--Submit button-->
                    <div>
                        <br>
                        <input class="loginbutton" type="submit" name="submit" value="login">
                        <br>
                    </div>
                    
                    <div>
                    <!--<a href="/ForgotPassword.html" class="forgetPassword">Forgot password?</a>-->
    
                    <p class="font-body">Need an account? <a href= "/SignUp.php" class="link">SIGN UP HERE</a></p>
    
                    </div>
    
                </div> <!--End of loginbox div-->  

            </div>
               
                
        </form>

        
	
    </body>

    <script src="assets/js/loginScript.js"></script>
</html>