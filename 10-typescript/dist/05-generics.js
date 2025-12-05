"use strict";
class inventory {
    constructor() {
        this.items = [];
    }
    addItem(item) {
        this.items.push(item);
    }
    getItems() {
        return this.items;
    }
}
const charminventory = new inventory();
charminventory.addItem('Mothwing Cloak');
charminventory.addItem('Crystal Heath');
const output05 = document.getElementById('output05');
if (output05) {
    output05.innerHTML = `
        <li><b>Charms Collected:</b></li>
        <ul>${charminventory.getItems().map(c => `<li>${c}</li>`).join('')}</ul>
    `;
}
