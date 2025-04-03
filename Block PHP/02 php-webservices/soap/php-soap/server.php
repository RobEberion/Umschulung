<?php
class ProductService {
    public function getProduct($id) {
        $products = [
            1 => ["id" => 1, "name" => "Product 1", "price" => 29.99],
            2 => ["id" => 2, "name" => "Product 2", "price" => 39.99]
        ];
        return isset($products[$id]) ? json_encode($products[$id]) : 'Product not found';
    }
}

$server = new SoapServer("../wsdl/service.wsdl");
$server->setClass('ProductService');
$server->handle();
