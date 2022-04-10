var input_search = document.getElementById("input_search");
var games_container = document.getElementById("games_container");

const APIURL = "/symfony/ProjetSpeedrun/public/api/games";

function loadDoc() {
    const xhttp = new XMLHttpRequest();
    var input_search_value = input_search.value;
    if (input_search_value) {
        const url = APIURL + "?g_name=" + input_search.value +"&number=10";
        xhttp.onload = function() {

            var res = JSON.parse(xhttp.responseText);
            emptyLoad();

            var game_container = document.createElement('div');
            game_container.className="game_container";
            var game = document.createElement('div')
            game.className="game";
            var a = document.createElement('a');
            var game_img = document.createElement('div')
            game_img.className="game_img";
            var game_infos = document.createElement('div');
            game_infos.className="game_infos";
            var img = document.createElement('img');
            var h3 = document.createElement('h3');

            game_infos.appendChild(h3);
            game_img.appendChild(img);
            game.appendChild(game_img);
            game.appendChild(game_infos);
            
            a.appendChild(game);
            game_container.appendChild(a);

            res.forEach(element => {
                game_container
                    .children[0].href = element.url;

                game_container
                    .children[0]
                    .children[0]
                    .children[0].innerHTML = "<img src='" + element.link_img + "' alt='game_img'>";
            
                game_container
                    .children[0]
                    .children[0]
                    .children[1].innerHTML = "<h3>" + element.name + "</h3>";

                games_container.append(game_container.cloneNode(true));
                
            });
            setTimeout(() => {
            
            }, 1000);
        }
        xhttp.open("GET", url, true);
        xhttp.send();

    } else {
        emptyLoad();
    }
    
}

function emptyLoad() {
    games_container.innerHTML = "";
}
 

function eventPred() {
    input_search.addEventListener('input', loadDoc);
}


eventPred();