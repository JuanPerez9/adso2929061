function PowerUp(constructor: Function) {
    constructor.prototype.powered = true;
}

@PowerUp
class Character {
    name: string = "Hornet";
}

const hornet = new Character();

const output08 = document.getElementById('output08');

if(output08) {
    output08.innerHTML = `
        <li><b>Character:</b> ${hornet.name}</li>
        <li><b>Powered Up:</b> ${(hornet as any).powered}</li>
    `;
}