class MyProfile {
    constructor() {
        this.friendsListElement = document.querySelector("#friendsList");
        // var passwordElement = document.querySelector("#password");


        this.dataElement = document.querySelector("#data");
        this.userEmail = this.dataElement.innerHTML.trim();

        this.link = "http://localhost/assets/db/apiCall.php?call=getFriendsData&email="+this.userEmail;
    }

    CallToApi() {
        fetch(this.link, { mode: 'no-cors'})
        .then(function(response) {
            return response.json();
        }).then(function(data) {
            var m1 = new MyProfile()
            m1.AddFriend(data)
        });
    }

    AddFriend(response) {
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
}


var m = new MyProfile()
m.CallToApi()



