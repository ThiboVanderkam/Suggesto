dateElements = Array.from(document.querySelector(".dates").children);

var response = ""
link = "http://localhost/assets/db/apiCall.php?call=getFriendsBdays&email=r0886870@student.thomasmore.be"
fetch(link, { mode: 'no-cors'})
    .then(function(response) {
        return response.json();
    }).then(function(data) {
        response = data;
        console.log(response)
    });

bdayData = {
    "Jan Janssens1": "2022-05-06",
    "Jan Janssens1": "2022-05-06",
    "abc": "2022-05-06",
    "abc": "2022-05-06",
    "Jan Janssens1é": "2022-05-15",
    "abc3": "2022-05-15",
    "abc31": "2022-05-15",
    "abc32": "2022-06-15",
    "ABC32": "2022-07-15",
};

for (var i = 0; i < dateElements.length; i++){
    for (var friend in bdayData){
        if (dateElements[i].id.toString() == ("li-" + bdayData[friend]).toString()){
            dateElements[i].innerHTML+= '<br>' + friend;
        };
    };
};

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