<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Page</title>
        <link rel="stylesheet" href="/assets/css/adminEditUserPage.css" type="text/css">

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
                        <p>Edit a user's account. They might have difficulties editing their account or their name or email is offensive and must be removed.</p>
                    </div>
                
                </div> <!--End of upperbox div-->

                <div class="main-box">

                    <div id="topdiv">

                        <div>
                            <p>Search user by email</p>

                            <input type="text" placeholder="Search.." name="search">
                        </div>
                    
                    </div>

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

                        <!--Birthday-->
                        <div>
                            <br>
                            <label>Birthday</label>
                            <input type="date" name="birthday" id="form-birthday" required>
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
                            <input class="EditUserButton" type="submit" name="submit" value="Edit User">
                        </div>

                    </div>  
                
                </div><!--End of mainbox div--> 

            </div> <!--End of adminbox div-->  

        </div><!--End of grotere box div-->  
               
    </body>
</html>