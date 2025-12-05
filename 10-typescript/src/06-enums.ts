enum EnemyType {
    Flying,
    Grounds,
    Boss
}

const currentEnemy = EnemyType.Grounds

const output06 = document.getElementById('output06');

if(output06) {
    output06.innerHTML = `
        <li><b>Enemy Type:</b> ${EnemyType[currentEnemy]}</li>
        <li><b>Weapon:</b> ${currentEnemy}</li>
    `;
}