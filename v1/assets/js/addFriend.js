class AddFriend {
    
    constructor() {
        this.friendsListElement = document.querySelector("#friendsList");
        this.dataElement = document.querySelector("#data");

        var userEmail = this.dataElement.innerHTML.trim();
        this.link = "https://suggesto.thibovanderkam.be/assets/db/apiCall.php?call=getFriendsData&email="+userEmail
    }
    
    makeFriends(response) {
        var bdayData = {};
        // making the object with the name and bdays
        for (var i = 0; i < response.length; i++){
            //concatenating the names and bdays
            var name = response[i].l_firstname + " " + response[i].l_lastname;
            bdayData[name] = response[i].l_birthday; 
        };
        //printing the names in the sidebar
        for (var friend in bdayData ){
            if (bdayData[friend] != undefined){ //als bday undefined dan geen friend adden
                this.friendsListElement.innerHTML += "<li>" + friend + "</li>";
                console.log(friend);
            }
        };
    }

    callToApi() {
        fetch(this.link, { mode: 'no-cors'})
        .then(function(response) {
            return response.json();
        }).then(function(data) {
            var a1 = new AddFriend()
            a1.makeFriends(data)
        });
    }

}


var a = new AddFriend();
a.callToApi();


