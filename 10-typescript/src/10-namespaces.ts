namespace Game {
    export const title = "Hollow Knight: Silksong";
    export const protagonist = "Hornet";
}

const output10 = document.getElementById('output10');

if(output10) {
    output10.innerHTML = `
        <li><b>Game:</b> ${Game.title}</li>
        <li><b>Hero:</b> ${Game.protagonist}</li>
    `;
}