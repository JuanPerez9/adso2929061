"use strict";
var Game;
(function (Game) {
    Game.title = "Hollow Knight: Silksong";
    Game.protagonist = "Hornet";
})(Game || (Game = {}));
const output10 = document.getElementById('output10');
if (output10) {
    output10.innerHTML = `
        <li><b>Game:</b> ${Game.title}</li>
        <li><b>Hero:</b> ${Game.protagonist}</li>
    `;
}
