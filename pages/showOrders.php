<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../style/showOrderStyle.css">
    <title>Document</title>
</head>
<body>


<div class="container">
    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
        <h2>Vuoi aggiornare gli ordini?</h2>
        <table id = "orderTable">
            <thead>
            <tr>
                <th>Prodotto</th>
                <th>Quantità</th>
                <th>Cameriere</th>
                <th>Stato</th>
                <th>Data/Ora</th>
                <th>Azione</th>
            </tr>
            </thead>
            <tbody>
            <?php
            include "DB.php";

            if(isset($_POST['filtra'])) {
                $orders = json_decode(DB::getOrders($_POST['filtro']), true);
            } else {
                $orders = json_decode(DB::getOrders(""), true);
            }

            if($orders != null) {
                foreach ($orders as $order) {
                    echo '<tr>';
                    echo '<td>' . $order['prodotto'] . '</td>';
                    echo '<td>' . $order['quantità'] . '</td>';
                    echo '<td>' . $order['cameriere'] . '</td>';
                    echo '<td>' . $order['stato'] . '</td>';
                    echo '<td>' . $order['dataOra'] . '</td>';
                    if ($order['stato'] == "in attesa") {
                        echo '<td><label>Cambia Stato</label><input type = "checkbox" name =' . $order['IdOrdinazione'] . '></td>';
                    } else {
                        echo '<td></td>';
                    }
                    echo '</tr>';
                }
                if(isset($_POST['aggiorna']))
                {
                    foreach($orders as $order)
                        $r = isset($_POST[$order['IdOrdinazione']]) && DB::updateOrderState($order['IdOrdinazione']);
                }
            }
            ?>
            </tbody>
        </table>
        <input type="submit" value="Aggiorna" name="aggiorna" class="submit-button">
    </form>

    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
        <h1>Aggiungi un filtro</h1>
        <select name="filtro" id="">
            <option value=""></option>
            <option value="in attesa">Attende</option>
            <option value="servito">Servito</option>
        </select>
        <input type="submit" value="Filtra" name="filtra" class="submit-button">
    </form>
</div>
</body>
</html>
