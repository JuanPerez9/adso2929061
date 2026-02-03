type AttackResult = 'hit' | 'miss' | 'critical'

function performAttack(): AttackResult {
    return "critical";
}

const result = performAttack();

const output07 = document.getElementById('output07');

if(output07) {
    output07.innerHTML = `
        <li><b>Attack Result:</b> ${result.toUpperCase()}</li>
    `;
}