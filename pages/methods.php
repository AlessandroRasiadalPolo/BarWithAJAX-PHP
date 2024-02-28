<?php
include "DB.php";

$orders = json_decode(DB::getOrders(""), true);

echo json_encode($orders);