function updateOrder(){
    document.getElementById('orderTable').addEventListener('click', function() {
        fetch('https://example.com/api/user')
            .then(function(response) {
                return response.json(); // Trasforma la risposta in JSON
            })
            .then(function(data) {
                // Aggiorna il contenuto di #user-data con i dati ricevuti
                document.getElementById('user-data').innerHTML = 'Nome: ' + data.name + ', Email: ' + data.email;
            })
            .catch(function(error) {
                console.log('Errore durante il recupero dei dati:', error);
            });
    });

}