interface Character {
    name: string;
    health: number;
    mana: number;
}

const update: Partial<Character> = { health: 80};

const output12 = document.getElementById('output12');

if(output12) {
    output12.innerHTML = `
        <li><b>Updated Property:</b> health</li>
        <li><b>new Value:</b> ${update.health}</li>
    `;
}