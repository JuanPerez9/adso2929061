"use strict";
function DividirRecursos(recursos, jugadores) {
    if (jugadores <= 0) {
        throw new Error("Debe haber al menos un jugador");
    }
    return recursos / jugadores;
}
let recursos = 0;
const recursos_totales = 500;
const jugadores = 4;
try {
    recursos = DividirRecursos(recursos_totales, jugadores);
}
catch (error) {
    recursos = 0;
    console.log("Error manejado:", error.message);
}
const output15 = document.getElementById('output15');
if (output15) {
    output15.innerHTML = `
        <li><b>Recursos Totales:</b> ${recursos_totales}</li>
        <li><b>Jugadores:</b> ${jugadores}</li>
        <li><b>Recursos por Jugador:</b> ${recursos}</li>
    `;
}
