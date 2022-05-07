//makes an array from the li squares for the dates
var dateElements = Array.from(document.querySelector(".dates").children);
var friendsListElement = document.querySelector("#friendsList");

var dataElement = document.querySelector("#data");
var userEmail = dataElement.innerHTML.trim();

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

        // making the object wit h the name and bdays
        for (var i = 0; i < response.length; i++){
            //concatenating the names and bdays
            var name = response[i].l_firstname + " " + response[i].l_lastname;
            bdayData[name] = response[i].l_birthday; 
        };
        //printin the names on the right date
        for (var friend in bdayData ){
            for (var i = 0; i < dateElements.length; i++){
                if (dateElements[i].id.toString() == ("li-" + bdayData[friend]).toString()){
                    dateElements[i].innerHTML+= '<br>' + friend;
                };
            };
            if (bdayData[friend] != undefined){ //als undefined dan geen friend adden
                friendsListElement.innerHTML += "<li>" + friend + "</li>";
            }
        };
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