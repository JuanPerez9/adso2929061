function DividirRecursos(recursos: number, jugadores: number): number {
    if (jugadores <= 0) {
        throw new Error("Debe haber al menos un jugador");
    }
    return recursos / jugadores;
}

let recursos: number = 0;
const recursos_totales: number = 500;
const jugadores: number = 4;

try {
    recursos = DividirRecursos(recursos_totales, jugadores);
} catch (error) {
    recursos = 0;
    console.log("Error manejado:", (error as Error).message);
}

const output15 = document.getElementById('output15');

if (output15) {
    output15.innerHTML = `
        <li><b>Recursos Totales:</b> ${recursos_totales}</li>
        <li><b>Jugadores:</b> ${jugadores}</li>
        <li><b>Recursos por Jugador:</b> ${recursos}</li>
    `;
}