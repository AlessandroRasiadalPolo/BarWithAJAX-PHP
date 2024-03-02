<?php
include "DB.php";

if(isset($_GET['filtro'])){
    $orders = json_decode(DB::getOrders($_GET['filtro']), true);
    echo json_encode($orders);
} else {
    $orders = json_decode(DB::getOrders(""), true);
    echo json_encode($orders);
}