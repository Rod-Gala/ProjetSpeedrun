var inputPred = document.getElementById("test");
var gamePred = document.getElementById("predictionSearch");

const APIURL = "/symfony/ProjetSpeedrun/public/api/games";

function loadDoc() {
    const xhttp = new XMLHttpRequest();
    
    if (test.value) {
        const url = APIURL + "?g_name=" + inputPred.value;

        emptyLoad();
        var addDiv = document.createElement('div');
        addDiv.className = "gameResult";
        var addLink = document.createElement('a');
        addDiv.appendChild(addLink);
        addDiv.children[0].innerHTML = "<i class='fas fa-ellipsis-h'></i>";
        gamePred.append(addDiv);

        xhttp.onload = function() {
            emptyLoad();
            var res = JSON.parse(xhttp.responseText);
            var addCode;

            res.forEach(element => {
                addCode = addDiv;
                addCode.children[0].href = element.url;
                addCode.children[0].innerText = element.name;
                gamePred.append(addCode.cloneNode(true));
            });

            if (test.value) {
            showPredDiv();
            }
            
        }
        xhttp.open("GET", url, true);
        xhttp.send();
    } else {
        emptyLoad();
        hidePredDiv();
    }
    
}


function emptyLoad() {
    gamePred.innerHTML = "";
}

function showPredDiv() {
    gamePred.style.display = "block";
}

function hidePredDiv() {
    gamePred.style.display = "none";
}

function changeField() {
    if (inputPred.style.width == "300px") {
        inputPred.style.width = "100px";
    } else {
        inputPred.style.width = "300px";
    }
    
}
 

function eventPred() {
    inputPred.addEventListener('input', loadDoc);
    inputPred.addEventListener('focusin', changeField);
    inputPred.addEventListener('focusin', showPredDiv);
    inputPred.addEventListener('focusout', changeField);
    inputPred.addEventListener('focusout', hidePredDiv);
}


eventPred();