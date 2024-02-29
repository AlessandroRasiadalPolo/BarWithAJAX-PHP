function updateOrder() {
    fetch("../pages/methods.php", {
        method: 'GET'
    })
        .then(response => {
            return response.json();
        })
        .then(data => {
            // Cancella il contenuto attuale della tabella
            document.getElementById('orderTable').innerHTML = '';

            // Aggiungi ogni ordine alla tabella
            data.forEach(order => {
                var tableRow = '<tr>' +
                    '<td>' + order.prodotto + '</td>' +
                    '<td>' + order.quantità + '</td>' +
                    '<td>' + order.cameriere + '</td>' +
                    '<td>' + order.stato + '</td>' +
                    '<td>' + order.dataOra + '</td>' +
                    '<td><label>Cambia Stato</label><input type="checkbox" name="' + order.IdOrdinazione + '"></td>' +
                    '</tr>';

                document.getElementById('orderTable').innerHTML += tableRow;
            });

            // Ripeti il polling dopo un intervallo di tempo (ad esempio, ogni 5 secondi)
            setTimeout(updateOrder, 5000);
        })
        .catch(error => {
            console.error('Errore durante l\'aggiornamento della tabella:', error);
            // Ripeti il polling dopo un intervallo di tempo anche in caso di errore
            setTimeout(updateOrder, 5000);
        });
}

updateOrder(); // Avvia il polling quando la pagina viene caricata