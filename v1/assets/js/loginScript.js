var test = ""
link = "http://localhost/assets/db/apiCall.php?call=login&email=r0886870@student.thomasmore.be&password=Bartje123"
    fetch(link, { mode: 'no-cors'})
        .then(function(response) {
            return response.json();
        }).then(function(data) {
            test = data;
            console.log(test)
        });