//makes an array from the li squares for the dates


class Calendar {
    constructor() {
        this.dateElements = Array.from(document.querySelector(".dates").children);
        this.friendsListElement = document.querySelector("#friendsList");
        this.dateListElement = document.querySelector("#dateList");
        
        this.dataElement = document.querySelector("#data");
        this.userEmail = this.dataElement.innerHTML.trim();
        this.link = "http://localhost/assets/db/apiCall.php?call=getFriendsData&email="+this.userEmail;
    }

    calendarInteraction(response) {
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
            for (var i = 0; i < this.dateElements.length; i++){
                if (this.dateElements[i].id.toString().substring(8) == (bdayData[friend]).toString().substring(5)){
                    this.dateElements[i].innerHTML+= '<span class="friend friend'+this.dateElements[i].id.toString().substring(8)+'">' + friend + '</span>'; 
                    // span to distinguish between day, friend(css), and friend'date'(for js) to later be able to add it to friends links
                };
            };
            if (bdayData[friend] != undefined){ //als undefined dan geen friend adden
                this.friendsListElement.innerHTML += "<li>" + friend + "</li>";
            }
        };

        for (var i = 0; i < this.dateElements.length; i++){
            this.dateElements[i].addEventListener("click", function() {
                document.querySelector("#dateList").innerHTML = ''; //clearing innerhtml when clicking on something new
                var friendElements = document.querySelectorAll(".friend"+this.id.toString().substring(8));
                //making friend form and getting its inner html to display submit button
                //the hidden input item holds the id value of the clicked friend top post it to the preferences
                for (var j = 0; j < friendElements.length; j++){
                    document.querySelector("#dateList").innerHTML 
                    +=  "<li><form action=myPreferences.php method=POST>" //value of friendId is friendId when submitting so you can call to their interests
                    + "<input type=hidden name=friendId value=" + idData[friendElements[j].innerHTML]+"></input>"
                    + "<input type=submit value='"+friendElements[j].innerHTML+ "'></input>"
                    + "</form></li>"; 
                }
            })
        }
    }

    callToApi() {
        fetch(this.link, { mode: 'no-cors'})
        .then(function(response) {
            return response.json();
        }).then(function(data) {
            var c1 = new Calendar();
            c1.calendarInteraction(data)
        });
    }

}

c = new Calendar()
c.callToApi()


var calendarButton = document.querySelector("#calendarButton");
calendarButton.addEventListener("click", function() {
    window.location.href = "../../calendar.php"
});


var addFriendEmailButton = document.querySelector("#addFriendEmailButton");
addFriendEmailButton.addEventListener("click", function() {
    window.location.href = "../../addFriendEmail.php"
});

var profileButton = document.querySelector("#profileButton");
profileButton.addEventListener("click", function() {
    window.location.href = "../../profilePage.php" //moet Arne nog doen
});

