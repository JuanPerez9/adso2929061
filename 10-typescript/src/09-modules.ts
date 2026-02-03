export const maxhealth = 100;
export function heal(amount: number): number {
    return amount;
}

const healed = heal(25);

const output09 = document.getElementById('output09');

if(output09) {
    output09.innerHTML = `
        <li><b>Max Health:</b> ${maxhealth}</li>
        <li><b>Healed:</b> ${healed}</li>
    `;
}
