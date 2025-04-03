<?php
function callRestAPI() {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:8000/rest/server.php");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    echo "GET All Products:\n";
    print_r(json_decode($response, true));

    $newProduct = json_encode([
        "name" => "New Product",
        "price" => 49.99
    ]);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost:8000/rest/server.php");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $newProduct);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    echo "\nPOST New Product:\n";
    print_r(json_decode($response, true));
}

callRestAPI();
