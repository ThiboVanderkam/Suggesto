var friendsListElement = document.querySelector("#friendsList");
var dataElement = document.querySelector("#data");
var userEmail = dataElement.innerHTML.trim();

// VRIENDENCODE [

var response;
link = "http://localhost/assets/db/apiCall.php?call=getFriendsData&email="+userEmail;

fetch(link, { mode: 'no-cors'})
    .then(function(response) {
        return response.json();
    }).then(function(data) {
        response = data;
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
                friendsListElement.innerHTML += "<li>" + friend + "</li>";
            }
        };
    }
);
// EINDE VRIENDECODE ]


// SCRAPER IN FOTOS [

var friendId = document.querySelector("#dataFriend").innerHTML.trim(); 
// hier neemt hij de id van de aangeduide friend mee vanuit een hidden div
// in die hidden div staat gewoon de friend id gepost wanneer je op de form vanuit de calendar klikt
link = "http://localhost/assets/db/apiCall.php?call=preferencesId&id="+friendId;
var scrapedLinks = [];
var scrapedFotoLinks = [];
var scrapedPreference = [];
var scrapedPrices = [];
var indexes = [];
var firstPreference = "";
var response;
fetch(link, { mode: 'no-cors'})
    .then(function(response) {
        return response.json();
    }).then(function(data) {
        response = data;
        firstPreference = String(response[0].preference); // eerste pref nemen
        for (var i = 0; i < response.length; i++){
            var link = String(response[i].link);
            var fotoLink = String(response[i].fotoLink);
            var preference = String(response[i].preference);
            var price = "€" + String(response[i].prijs);
            // console.log(i + " " + preference + " " + typeof(preference));

            scrapedLinks.push(link);
            scrapedFotoLinks.push(fotoLink);
            scrapedPreference.push(preference);
            scrapedPrices.push(price);

            if(preference != firstPreference) {
                firstPreference = preference;
                indexes.push(i); // geeft index van scrapedPreferences die anders is (om aan nieuwe rij boxes te beginnen)
            }
        };

        console.log(response);
    }
);

var allBoxElements = document.querySelectorAll(".box");
var pageElement = document.querySelector("#ForMe-div");

setTimeout(function(){ // wachten want moet er nog inkomen
    var uniquePreferences = Array.from(new Set(scrapedPreference)); // unieke waarden krijgen uit preferences
    var catBegin = "<div class='categoryDiv font-body'>";
    var boxBegin = "<div class='box'>";
    var suggDiv = "<div class='suggestion-div'>"
    var divEnd = "</div>";
    
    var aantCategorien = uniquePreferences.length;
    for (var i = 0; i < aantCategorien; i++) {
        pageElement.innerHTML += catBegin + divEnd; //categoryDivs erinzetten
    };
    var allCategoryTiles = document.querySelectorAll(".categoryDiv");
    for (var i = 0; i < allCategoryTiles.length; i++) { //category dividers erinzetten
        allCategoryTiles[i].innerHTML = uniquePreferences[i] + ":" + "<br>";
    };

    for (var i = 0; i < allCategoryTiles.length; i++) { //suggestionDivs in tiles zetten (om de boxes mooi naast elkaar te krijgen)
        for (var j = 0; j < Math.ceil(scrapedFotoLinks.length/uniquePreferences.length/4); j++ ) // voor de suggestionDivs aantal te weten dat je moet printen als je 4 producten per rij wilt
        allCategoryTiles[i].innerHTML += suggDiv + divEnd;
    };
    var allSuggDivs = document.querySelectorAll(".suggestion-div");
    var boxDivCount = 0; // het worden veel variabelen, i know srry, ma deze is voor te checken dat er maar enkel 4 boxen op een lijn mogen, anders is lay out lelijk `~`

    var suggestionDivIndex = 0;
    for (var i = 0; i < scrapedFotoLinks.length; i++) { //boxes erin zetten
        if(boxDivCount%4 == 0 && boxDivCount != 0) {
            for (var y = 0; y < indexes.length; y++) {
                if(boxDivCount == indexes[y]) {
                    suggestionDivIndex++;
                    boxDivCount = 0;
                    break;
                }
            };
            suggestionDivIndex++;
            allSuggDivs[suggestionDivIndex].innerHTML += "<a href=' " + scrapedLinks[i] + "' target='_blank'><img src='" + scrapedFotoLinks[i] + "' alt='productImage'></a>";
            boxDivCount++;
        }
        else {
            for (var y = 0; y < indexes.length; y++) {
                if(boxDivCount == indexes[y]) {
                    suggestionDivIndex++;
                    boxDivCount = 0;
                    break;
                }
            };
            allSuggDivs[suggestionDivIndex].innerHTML += "<a href=' " + scrapedLinks[i] + "' target='_blank'><img src='" + scrapedFotoLinks[i] + "' alt='productImage'></a>";
            boxDivCount++;
        }
    };



    // console.log(scrapedLinks);
    // console.log(scrapedFotoLinks);
    // console.log(scrapedPreference);

}, 2500);

// EINDE SCRAPER IN FOTOS ]


