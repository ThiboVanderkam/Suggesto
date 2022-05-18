var friendsListElement = document.querySelector("#friendsList");
var dataElement = document.querySelector("#data");
var userEmail = dataElement.innerHTML.trim();

var friendId = document.querySelector("#dataFriend").innerHTML.trim();
link = "http://localhost/assets/db/apiCall.php?call=preferencesId&id="+friendId;
var response;
fetch(link, { mode: 'no-cors'})
    .then(function(response) {
        return response.json();
    }).then(function(data) {
        response = data;
        console.log(response)
    }
);

// voor later alles in boxen te zetten:
var allBoxElements = document.querySelectorAll(".box");
for (var i = 0; i < allBoxElements.length; i++) {
    console.log(allBoxElements[i]);
}