"use strict";
function VerificarSalud(salud) {
    return new Promise((resolve, reject) => {
        if (salud > 0) {
            resolve("¡Jugador con vida!");
        }
        else {
            reject("Jugador derrotado");
        }
    });
}
let mensaje = "";
const PuntosdeVida = 75;
function ProcesarSalud() {
    return VerificarSalud(PuntosdeVida)
        .then((msg) => {
        mensaje = msg;
    })
        .catch((error) => {
        mensaje = `Aviso!: ${error}`;
    });
}
ProcesarSalud().then(() => {
    const output14 = document.getElementById('output14');
    if (output14) {
        output14.innerHTML = `
            <li><b>Estado de Salud:</b> ${mensaje}</li>
            <li><b>Puntos de Vida:</b> ${PuntosdeVida}</li>
        `;
    }
});
