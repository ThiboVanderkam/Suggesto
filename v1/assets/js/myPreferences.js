allBoxElements = document.querySelectorAll(".box");
for (var i = 0; i < allBoxElements.length; i++) {
    console.log(allBoxElements[i]);
}
// eerst alle elementen v database krijgen, erover loopen en in innerhtml link, titel enz zetten

// allCategoryBoxes = document.querySelectorAll(".category-box");
// for (var i = 0; i < allCategoryBoxes.length; i++) {
//     console.log(allCategoryBoxes[i]);
// }

// var friendsListElement = document.querySelector("#friendsList");
// var usernameElement = document.querySelector("#username");
// var emailAddressElement = document.querySelector("#emailAddress");
// // var passwordElement = document.querySelector("#password");


// var dataElement = document.querySelector("#data");
// var userEmail = dataElement.innerHTML.trim();

// var response;
// link = "http://localhost/assets/db/apiCall.php?call=getFriendsData&email="+userEmail;

// fetch(link, { mode: 'no-cors'})
//     .then(function(response) {
//         return response.json();
//     }).then(function(data) {
//         response = data;
//         var bdayData = {};
//         // making the object with the name and bdays
//         for (var i = 0; i < response.length; i++){
//             //concatenating the names and bdays
//             var name = response[i].l_firstname + " " + response[i].l_lastname;
//             bdayData[name] = response[i].l_birthday; 
//         };
//         //printing the names in the sidebar
//         for (var friend in bdayData ){
//             if (bdayData[friend] != undefined){ //als bday undefined dan geen friend adden
//                 friendsListElement.innerHTML += "<li>" + friend + "</li>";
//                 console.log(friend);
//             }
//         };
//     }
// );

// hieronder
console.log("connected");

var test = ""
// $_POST["friendId"]
link = "http://localhost/assets/db/apiCall.php?call=preferencesId&id=1";
fetch(link, { mode: 'no-cors'})
    .then(function(response) {
        // return JSON.parse(response.text())["[0]"];
        // return eval('({' + response.text() + '})');
        return response;
    }).then(function(data) { // hier moet het werkende gedeelte worden
        console.log(JSON.parse(response));

    });
