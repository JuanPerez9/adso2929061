function ObtenerVida(): Promise<string> {
    return new Promise((resolve) => {
        setTimeout(() => {
            resolve("Vida Obtenida!");
        }, 2000);
    });
}

let resultado: string = "";

async function ProcesarVida() {
    resultado = await ObtenerVida();
}

ProcesarVida().then(() => {
    
    const output13 = document.getElementById('output13');
    
    if(output13) {
        output13.innerHTML = `
            <li><b>Health Status:</b> ${resultado}</li>
            <li><b>Time:</b> 2 Second</li>
        `;
    }
});


