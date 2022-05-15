//makes an array from the li squares for the dates
var dateElements = Array.from(document.querySelector(".dates").children);
var friendsListElement = document.querySelector("#friendsList");

var dataElement = document.querySelector("#data");
var userEmail = dataElement.innerHTML.trim();

var dateListElement = document.querySelector("#dateList");

var response;
link = "http://localhost/assets/db/apiCall.php?call=getFriendsData&email="+userEmail;
fetch(link, { mode: 'no-cors'})
    .then(function(response) {
        return response.json();
    }).then(function(data) {
        response = data;
        
        //need to do this here because:
        //https://stackoverflow.com/questions/57139456/variables-being-changed-in-fetch-but-unchanged-outside-of-function
        var bdayData = {};
        var idData = {};
        // making the object wit h the name and bdays
        for (var i = 0; i < response.length; i++){
            //concatenating the names and bdays
            var name = response[i].l_firstname + " " + response[i].l_lastname;
            bdayData[name] = response[i].l_birthday; 
            idData[name] = response[i].local_id;            
        };
        //printin the names on the right date
        for (var friend in bdayData ){
            for (var i = 0; i < dateElements.length; i++){
                if (dateElements[i].id.toString().substring(8) == (bdayData[friend]).toString().substring(5)){
                    dateElements[i].innerHTML+= '<span class="friend friend'+dateElements[i].id.toString().substring(8)+'">' + friend + '</span>'; 
                    // span to distinguish between day, friend(css), and friend'date'(for js) to later be able to add it to friends links
                };
            };
            if (bdayData[friend] != undefined){ //als undefined dan geen friend adden
                friendsListElement.innerHTML += "<li>" + friend + "</li>";
            }
        };

        for (var i = 0; i < dateElements.length; i++){
            dateElements[i].addEventListener("click", function() {
                dateListElement.innerHTML = ''; //clearing innerhtml when clicking on something new
                var friendElements = document.querySelectorAll(".friend"+this.id.toString().substring(8));
                //making friend form and getting its inner html to display submit button
                for (var j = 0; j < friendElements.length; j++){
                    console.log(idData[friendElements[j].innerHTML])
                    dateListElement.innerHTML 
                    +=  "<li><form action=myPreferences.php method=POST>" //value of friendId is friendId when submitting so you can call to their interests
                    + "<input type=hidden name=friendId value=" + idData[friendElements[j].innerHTML]+"></input>"
                    + "<input type=submit value="+friendElements[j].innerHTML+ "</input>"
                    + "</form></li>"; 
                }
            })
        }
    }
);
    

calendarButton = document.querySelector("#calendarButton");
calendarButton.addEventListener("click", function() {
    window.location.href = "../../calendar.php"
});


addFriendEmailButton = document.querySelector("#addFriendEmailButton");
addFriendEmailButton.addEventListener("click", function() {
    window.location.href = "../../addFriendEmail.php"
});

profileButton = document.querySelector("#profileButton");
profileButton.addEventListener("click", function() {
    window.location.href = "../../profilePage.php" //moet Arne nog doen
});

