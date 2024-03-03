document.addEventListener('DOMContentLoaded', function() {
document.getElementById('update-table').addEventListener('click', updateTable) });

function updateTable(){
    // Effettua una richiesta fetch all'endpoint API
    fetch('../pages/methods.php')
        .then(function (response) {
            // Controlla se la risposta è stata ricevuta correttamente
            if (!response.ok) {
                // Se la risposta non è ok, lancia un errore
                throw new Error('Errore durante il recupero dei dati: ' + response.status);
            }
            // Trasforma la risposta in formato JSON
            return response.json();
        })
        .then(function (data) {
            // Aggiorna il contenuto della tabella con tutte le righe generate
            document.getElementById('orderTable').innerHTML = createTable();
        })
        .catch(function (error) {
            // Gestisci gli errori qui
            console.error(error);
        });
}
document.addEventListener("DOMContentLoaded", function () {document.getElementById("selectFiltro").addEventListener("click", filterOrders)
})


function filterOrders(){
    var filtro = document.getElementById("sceltaFiltro").value;
    fetch('../pages/methods.php?filtro=' + filtro)
        .then(function (response) {
            // Controlla se la risposta è stata ricevuta correttamente
            if (!response.ok) {
                // Se la risposta non è ok, lancia un errore
                throw new Error('Errore durante il recupero dei dati: ' + response.status);
            }
            // Trasforma la risposta in formato JSON
            return response.json();
        })
        .then(function (data) {
            // Costruisci il contenuto della tabella con i dati ricevuti
            // Aggiorna il contenuto della tabella con tutte le righe generate
            document.getElementById('orderTable').innerHTML = createTable(data);
        })
        .catch(function (error) {
            // Gestisci gli errori qui
            console.error(error);
        });
}




function createTable(data){
    var tableHTML = "";
    data.forEach(function (order) {
        // Per ogni ordine, crea una riga della tabella con i dati dell'ordine
        tableHTML += '<tr>' +
            '<td>' + order.prodotto + '</td>' +
            '<td>' + order.quantità + '</td>' +
            '<td>' + order.cameriere + '</td>' +
            '<td>' + order.stato + '</td>' +
            '<td>' + order.dataOra + '</td>' +
            '<td><label>Cambia Stato</label><input type="checkbox" name="' + order.IdOrdinazione + '"></td>' +
            '</tr>';
    });

    return tableHTML;
}
