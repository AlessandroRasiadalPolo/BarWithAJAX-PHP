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
                    '</tr>';
                document.getElementById('orderTable').innerHTML += tableRow;
            });
        })
        .catch(error => {
            console.error('Errore durante l\'aggiornamento della tabella:', error);
            setTimeout(updateOrder, 5000);
        });
}

updateOrder();


