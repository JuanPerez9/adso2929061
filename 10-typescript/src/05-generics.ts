class inventory<T> {
    private items: T[] = [];

    addItem(item: T): void {
        this.items.push(item);
    }
    getItems(): T[] {
        return this.items;
    }
}

const charminventory = new inventory<string>();
charminventory.addItem('Mothwing Cloak');
charminventory.addItem('Crystal Heath');

const output05 = document.getElementById('output05');

if(output05) {
    output05.innerHTML = `
        <li><b>Charms Collected:</b></li>
        <ul>${charminventory.getItems().map(c => `<li>${c}</li>`).join('')}</ul>
    `;
}