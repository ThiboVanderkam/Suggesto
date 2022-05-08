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
        console.log(response);
        var bdayData = {};

        // making the object wit h the name and bdays
        for (var i = 0; i < response.length; i++){
            //concatenating the names and bdays
            var name = response[i].l_firstname + " " + response[i].l_lastname;
            bdayData[name] = response[i].l_birthday; 
        };
        //printin the names on the right date
        for (var friend in bdayData ){
            if (bdayData[friend] != undefined){ //als undefined dan geen friend adden
                friendsListElement.innerHTML += "<li>" + friend + "</li>";
                console.log(friend);

            }
        };
    }
);
