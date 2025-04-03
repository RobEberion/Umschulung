<?php
error_reporting(E_ALL & ~E_DEPRECATED);
ini_set('display_errors', 1);

require_once __DIR__ . '/../../vendor/autoload.php';

$server = new nusoap_server();
$server->configureWSDL('ProductService', 'urn:productservice');

$server->register(
    'getProduct',
    array('id' => 'xsd:integer'),
    array('return' => 'xsd:string'),
    'urn:productservice',
    'urn:productservice#getProduct',
    'rpc',
    'encoded',
    'Get product details'
);

function getProduct($id) {
    $products = array(
        1 => array('id' => 1, 'name' => 'Product 1', 'price' => 29.99),
        2 => array('id' => 2, 'name' => 'Product 2', 'price' => 39.99)
    );
    return isset($products[$id]) ? json_encode($products[$id]) : 'Product not found';
}

$server->service(file_get_contents("php://input"));
