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
                <a href="#" class="">Hello user</a>
                <!-- hier nog naam en foto poppen van de user -->
            </div>

            <a href="#" class="bestFriends"><u>Best Friends</u></a>
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
                <!-- <ul>
                    <li><a href="#">Add Friend Account</a></li>
                    <li><a href="#">Add friend without account</a></li>
                    <li><a href="#">Edit Friend</a></li>
                </ul> -->
            </div>

            <hr> 
            <br>
            <br>

            <div id="addFriendPage" class="font-body"> <!-- is eig gwn de friendsPage.php -->
                <div class="blueDiv border">
                    <br>
                    <br>
                    <br>
                    <br>
                    <label for="friendEmailInput">Friend e-mail:</label>
                    <br>
                    <input type="text" id="friendEmailInput">

                    <!-- ---- optioneel ---- -->

                    <br>
                    <br>
                    <label for="friendNicknameInput">(optional) Set friend nickname:</label>
                    <br>
                    <input type="text" id="friendNicknameInput">

                    <br>
                    <br>
                    <input type="submit">

                </div>
            </div>

    
            
        </div> 
        <script src="assets/js/script.js">
        </script>
    </body>
</html>