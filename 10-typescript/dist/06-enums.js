"use strict";
var EnemyType;
(function (EnemyType) {
    EnemyType[EnemyType["Flying"] = 0] = "Flying";
    EnemyType[EnemyType["Grounds"] = 1] = "Grounds";
    EnemyType[EnemyType["Boss"] = 2] = "Boss";
})(EnemyType || (EnemyType = {}));
const currentEnemy = EnemyType.Grounds;
const output06 = document.getElementById('output06');
if (output06) {
    output06.innerHTML = `
        <li><b>Enemy Type:</b> ${EnemyType[currentEnemy]}</li>
        <li><b>Weapon:</b> ${currentEnemy}</li>
    `;
}
