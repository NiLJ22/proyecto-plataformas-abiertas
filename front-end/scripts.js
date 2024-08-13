document.addEventListener("DOMContentLoaded", function() {
    // Cargar datos de marcas con ventas
    fetch('/proyecto-api/API/marcas')
        .then(response => response.json())
        .then(data => populateTable('marcas-table', data))
        .catch(error => console.error('Error fetching marcas:', error));

    // Cargar datos de prendas
    fetch('/proyecto-api/API/prendas')
        .then(response => response.json())
        .then(data => populateTable('prendas-table', data))
        .catch(error => console.error('Error fetching prendas:', error));

    // Cargar top 5 marcas más vendidas
    fetch('/proyecto-api/API/top-brands')
        .then(response => response.json())
        .then(data => populateTable('top-brands-table', data))
        .catch(error => console.error('Error fetching top brands:', error));
});

function populateTable(tableId, data) {
    const table = document.getElementById(tableId);
    const tbody = table.querySelector('tbody');
    tbody.innerHTML = ''; // Clear existing rows

    data.forEach(item => {
        const row = document.createElement('tr');
        for (const key in item) {
            if (item.hasOwnProperty(key)) {
                const cell = document.createElement('td');
                cell.textContent = item[key];
                row.appendChild(cell);
            }
        }
        tbody.appendChild(row);
    });
}
