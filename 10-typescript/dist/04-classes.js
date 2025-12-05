"use strict";
class Enemy {
    constructor(name, health) {
        this.name = name;
        this.health = health;
    }
    takeDamage(damage) {
        this.health -= damage;
    }
}
const roach = new Enemy('Roach', 100);
roach.takeDamage(15);
roach.takeDamage(15);
roach.takeDamage(15);
const output04 = document.getElementById('output04');
if (output04) {
    output04.innerHTML = `
        <li><b>Name Enemy:</b> ${roach.name}</li>
        <li><b>Total Health after for 3 Attacks:</b> ${roach.health}</li>
    `;
}
