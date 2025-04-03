<?php
$client = new SoapClient("../wsdl/service.wsdl");
$result = $client->getProduct(1);
echo "PHP-SOAP Result: " . $result;
