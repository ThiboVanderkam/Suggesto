<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="assets/css/giftPreferences.css" type="text/css">

        <!-- fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Italianno&family=Poppins:wght@300&display=swap" rel="stylesheet">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Italianno&family=Poppins:wght@200;300&display=swap" rel="stylesheet">
</head>
<body>
    <!-- ____________________________HomeDing (hierboven was sidebar)_______________________________ -->
    <div> <!-- MAIN maken voor de rest van de website buiten de sidebar -->
        <h1 class="border">SUGGESTO</h1>
        <div class="header-box">
            Edit your Preferences:
        </div>

        <div class="sidenav2 border font-body">
            <!-- <a href="myPreferences.php"><u id="forMe">For Me-Page </u></a>

            <br> -->

            <a href="giftPreferences.php"><u id="giftPreferences">Edit gift preferences</u></a>

            <br>

            <a href="myProfile.php" ><u id="myAccount">My account</u></a>

            <br>

            <a href="calendar.php"><u>Calendar</u></a>

            <br>

            <a href="addFriendEmail.php"><u>Friends</u></a>
        </div>

        <br>
        <br>
        <br>

        <div class="gift-preferences-main">
            <div id="gift-preferences" class="font-body border">
                <div id="pref-row-1">
                    <br>
                    <br>
                    <input type="checkbox" id="games" name="games" value="games">
                    <label for="games">Games</label>

                    <br>
                    <br>

                    <input type="checkbox" id="nature" name="nature" value="nature">
                    <label for="nature">Nature</label>

                    <br>
                    <br>

                    <input type="checkbox" id="potography" name="potography" value="potography">
                    <label for="potography">Photography</label>

                    <br>
                    <br>

                    <input type="checkbox" id="sports" name="sports" value="sports">
                    <label for="sports">Sports</label>

                    <br>
                    <br>

                    <input type="checkbox" id="tech" name="tech" value="tech">
                    <label for="tech">Tech</label>

                    <br>
                    <br>

                    <input type="checkbox" id="beauty" name="beauty" value="beauty">
                    <label for="beauty">Beauty</label>
                    <br>
                    <br>
                    <input type="submit" value="Change">

                </div>                
            </div>
        </div>
    </div> 
    <script src="assets/js/giftPreferences.js">
    </script>
    </body>
</html>