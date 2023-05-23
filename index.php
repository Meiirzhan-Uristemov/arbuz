<?php

// Database configuration
$host = 'localhost';
$dbname = 'arbuz';
$user = 'postgres';
$password = 'postgres';

// Include the handler functions file
require_once 'handlers.php';

// Establish a database connection
try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    $response = [
        'status' => 'error',
        'message' => 'Connection failed: ' . $e->getMessage()
    ];

    header('Content-Type: application/json');
    echo json_encode($response);
    die();
}

// Get the request method and URI
$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Remove query string from URI
$uri = strtok($uri, '?');

// Routing logic
if ($method === 'GET' && $uri === '/users') {
    // Handle GET request for /users endpoint
    getUsers($pdo);
} elseif ($method === 'POST' && $uri === '/user_basket') {
    // Handle POST request for /user_basket endpoint
    postUserBasket($pdo);
} elseif ($method === 'POST' && $uri === '/user_delivery') {
    // Handle POST request for /user_delivery endpoint
    postUserDelivery($pdo);
} else {
    // Handle invalid routes
    $response = [
        'status' => 'error',
        'message' => 'Invalid route'
    ];

    header('Content-Type: application/json');
    echo json_encode($response);
}

// Close the database connection
$pdo = null;

?>
