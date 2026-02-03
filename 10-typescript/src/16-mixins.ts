function movimiento<T extends { new(...args: any[]): {} }>(claseB: T) {
    return class extends claseB {
        mover(): string {
            return "El Personaje se movió";
        }
    };
}

function defensa<T extends { new(...args: any[]): {} }>(claseB: T) {
    return class extends claseB {
        defender(): string {
            return "El Personaje se defendió";
        }
    };
}

class player {
    nombre: string;

    constructor(nombre: string) {
        this.nombre = nombre;
    }
}

const playerA = defensa(movimiento(player));
const personaje = new playerA("Hornet");
const moverse = personaje.mover();
const defenderse = personaje.defender();


const output16 = document.getElementById('output16');

if (output16) {
    output16.innerHTML = `
        <li><b>Nombre:</b> ${personaje.nombre}</li>
        <li><b>Movimiento:</b> ${moverse}</li>
        <li><b>Defensa:</b> ${defenderse}</li>
    `;
}