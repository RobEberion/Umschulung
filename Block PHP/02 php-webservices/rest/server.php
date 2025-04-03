<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");

class ProductAPI {
    private $products = [
        ["id" => 1, "name" => "Product 1", "price" => 29.99],
        ["id" => 2, "name" => "Product 2", "price" => 39.99]
    ];

    public function handleRequest() {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        switch ($method) {
            case 'GET':
                isset($_GET['id']) ? $this->getProduct($_GET['id']) : $this->getAllProducts();
                break;
            case 'POST':
                $this->createProduct();
                break;
            default:
                http_response_code(405);
                echo json_encode(["error" => "Method not allowed"]);
        }
    }

    private function getAllProducts() {
        echo json_encode($this->products);
    }

    private function getProduct($id) {
        $product = array_filter($this->products, fn($p) => $p['id'] == $id);
        if (!empty($product)) {
            echo json_encode(array_values($product)[0]);
        } else {
            http_response_code(404);
            echo json_encode(["error" => "Product not found"]);
        }
    }

    private function createProduct() {
        $data = json_decode(file_get_contents('php://input'), true);
        if (json_last_error() === JSON_ERROR_NONE) {
            $newProduct = [
                "id" => count($this->products) + 1,
                "name" => $data['name'],
                "price" => $data['price']
            ];
            array_push($this->products, $newProduct);
            http_response_code(201);
            echo json_encode($newProduct);
        } else {
            http_response_code(400);
            echo json_encode(["error" => "Invalid JSON"]);
        }
    }
}

$api = new ProductAPI();
$api->handleRequest();
