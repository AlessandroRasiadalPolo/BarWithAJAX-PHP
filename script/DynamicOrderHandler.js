function updateOrder(){
    fetch("../pages/methods.php", {
        method: 'GET'
    })
            .then(response => {
                return response.json();
            })
            .then(data => {
                // Aggiorna dinamicamente la tabella con i nuovi dati
                var tableRow = '<tr><td>' + data.prodotto + '</td><td>' + data.quantità + '</td>' +
                    '<td>' + data.cameriere + '</td><td>' + data.stato + '</td>' +
                    <td>' + data.dataOra + '</td> +
                '</tr>';
                document.getElementById('orderTable').innerHTML += tableRow;
            })
            .catch(error => {
                console.log('Errore durante l\'aggiornamento della tabella:', error);
                setTimeout(updateOrder, 5000);
            });
}

updateOrder();


