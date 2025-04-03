<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../../vendor/autoload.php';

try {
    $client = new nusoap_client('http://localhost:8000/soap/nusoap/server.php?wsdl', true);
    $err = $client->getError();
    if ($err) {
        echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
        exit();
    }

    $result = $client->call('getProduct', array('id' => 1));
    if ($client->fault) {
        echo '<h2>Fault</h2><pre>';
        print_r($result);
        echo '</pre>';
    } else {
        $err = $client->getError();
        if ($err) {
            echo '<h2>Error</h2><pre>' . $err . '</pre>';
        } else {
            echo '<h2>Result</h2><pre>';
            print_r($result);
            echo '</pre>';
        }
    }
} catch (Exception $e) {
    echo 'Exception: ' . $e->getMessage();
}
