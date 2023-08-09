<?php

header('Content-Type: application/json');

require '../config/App.php';

$query = select("SELECT * FROM barang");

echo json_encode(['data_barang' => $query]);
