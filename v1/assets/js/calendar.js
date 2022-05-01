dateElements = Array.from(document.querySelector(".dates").children);

bdayData = {
    "Jan Janssens1": "2022-05-06",
    "Jan Janssens1": "2022-06-06",
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

