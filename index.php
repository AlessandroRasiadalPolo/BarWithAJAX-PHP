<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./style/indexStyle.css">
    <script src = "./script/DynamicOrderHandler.js"></script>
    <title>Document</title>
</head>
<body>

<?php
include "./pages/DB.php";
    if(isset($_POST['Ordina'])){
        $newOrder = array("cameriere" => $_POST['sceltaCameriere'], "prodotto" => $_POST['sceltaProdotto'], "quantità" => $_POST['quantità'], "stato" => "in attesa");
        DB::insertNewOrder($newOrder);
    }
?>

<!-- Il form deve includere: selezione del prodotto, selezione del cameriere,
    quantità e un pulsante per inviare l'ordinazione. -->
<br><br>
<form action="<?php echo $_SERVER['PHP_SELF']?>" method = "post">
    <label for="">Inserire il prodotto</label>
    <select name="sceltaProdotto" id="" required>
        <option value=""></option>
        <?php
        $camerieri = json_decode(DB::getElements("prodotto"), true);
        if ($camerieri != null) {
            foreach ($camerieri as $c) {
                echo "<option value='{$c}'>{$c}</option>";
            }
        }
        ?>
    </select>
    <label for="">Quantità</label>
    <input type="number" name="quantità" min="1" max="20" step="1" required>
    <br><br>

    <label for="">Inserire il cameriere</label>
    <select name="sceltaCameriere" id="" required>
        <option value=""></option>
        <?php
        $camerieri = json_decode(DB::getElements("cameriere"), true);
        if ($camerieri != null) {
            foreach ($camerieri as $c) {
                echo "<option value='{$c}'>{$c}</option>";
            }
        }
        ?>
    </select>

    <input type="submit" value="Ordina"  name = "Ordina">
</form>

<a href="pages/showOrders.php">Mostra gli ordini</a>



</body>
</html>