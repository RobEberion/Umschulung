<?php
$uddiRegistry = [
    'name' => 'ProductService',
    'description' => 'Product management web service',
    'provider' => 'Your Company',
    'endpoints' => [
        'rest' => 'http://localhost:8000/rest/server.php',
        'soap' => 'http://localhost:8000/soap/php-soap/server.php'
    ],
    'wsdl' => 'http://localhost:8000/soap/wsdl/service.wsdl'
];
