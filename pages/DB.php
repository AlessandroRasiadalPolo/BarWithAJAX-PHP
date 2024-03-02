<?php

class DB
{
    private static function connect()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbName = "bar";

        $conn = new mysqli($servername, $username, $password, $dbName);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        return $conn;
    }

    public static function insertNewOrder($order){

        $conn = self::connect();
        if($conn == null)
            return null;

        //Ottengo l'id del prodotto ordinato
        $sql_prodotto = "SELECT IDProdotto FROM prodotto WHERE Nome = ?";
        $stmt_prodotto = $conn->prepare($sql_prodotto);
        $stmt_prodotto->bind_param("s", $order['prodotto']);
        $stmt_prodotto->execute();
        $result_prodotto = $stmt_prodotto->get_result();
        $row_prodotto = $result_prodotto->fetch_assoc();
        $idProdotto = $row_prodotto['IDProdotto'];

        // Ottengo l'Id del cameriere
        $sql_cameriere = "SELECT IDCameriere FROM cameriere WHERE Nome = ?";
        $stmt_cameriere = $conn->prepare($sql_cameriere);
        $stmt_cameriere->bind_param("s", $order['cameriere']);
        $stmt_cameriere->execute();
        $result_cameriere = $stmt_cameriere->get_result();
        $row_cameriere = $result_cameriere->fetch_assoc();
        $idCameriere = $row_cameriere['IDCameriere'];

        // Inserisco tutti i dati
        $sql = "INSERT INTO ordinazione(IDProdotto, IDCameriere, Quantita, Stato, DataOra) VALUES (?, ?, ?, ?, NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iiis", $idProdotto, $idCameriere, $order['quantità'], $order['stato']);


        if($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }


    public static function getOrders($filter)
    {
        $con = self::connect();
        if($con == null)
            return null;

        if($filter == "") {

            $sql = "SELECT O.IDOrdinazione, P.Nome AS NomeProdotto, P.Prezzo AS Prezzo, O.Quantita, C.Nome AS Cameriere, O.Stato, O.DataOra  
                FROM Ordinazione O INNER JOIN CAMERIERE C ON(O.IDCameriere = C.IDCameriere) 
                    INNER JOIN Prodotto P ON (P.IDProdotto = O.IDProdotto) ORDER BY DataOra";
            $result = $con->query($sql);
        }
        else {
            $sql = "SELECT O.IDOrdinazione, P.Nome AS NomeProdotto, P.Prezzo AS Prezzo, O.Quantita, C.Nome AS Cameriere, O.Stato, O.DataOra  
                FROM Ordinazione O INNER JOIN CAMERIERE C ON(O.IDCameriere = C.IDCameriere) 
                    INNER JOIN Prodotto P ON (P.IDProdotto = O.IDProdotto) WHERE O.Stato = ? ORDER BY DataOra";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("s", $filter);
            $stmt->execute();
            $result = $stmt->get_result();
        }

        $ordinazioni = array();



        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $ordinazione = array();
                $ordinazione['prodotto'] = $row['NomeProdotto'];
                $ordinazione['quantità'] = $row['Quantita'];
                $ordinazione['prezzo'] = $row['Prezzo'];
                $ordinazione['cameriere'] = $row['Cameriere'];
                $ordinazione['stato'] = $row['Stato'];
                $ordinazione['dataOra'] = $row['DataOra'];
                $ordinazione['IdOrdinazione'] = $row['IDOrdinazione'];

                $ordinazioni[] = $ordinazione;
            }
            return json_encode($ordinazioni);
        }
        return null;
    }


    public static function updateOrderState($orderID)
    {
        $con = self::connect();
        if ($con != null) {
            $sql = "UPDATE ordinazione SET Stato = 'servito' WHERE Stato = 'in attesa' AND IDOrdinazione = ?";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("i", $orderID);

            if ($stmt->execute()) {
                $stmt->close();
                return true;
            } else {
                $stmt->close();
                return false;
            }
        }
        return false;
    }
}