<?php

// Get users from the database
function getUsers($pdo) {
    // Example: Retrieve users from the database
    // Your code here
    // ...
}

// Insert a new item into the user_basket table
function postUserBasket($pdo) {
    // Get the request payload
    $requestData = json_decode(file_get_contents('php://input'), true);

    // Validate the required fields
    if (
        empty($requestData['user_id']) ||
        empty($requestData['product']) ||
        empty($requestData['quantity'])
    ) {
        $response = [
            'status' => 'error',
            'message' => 'Missing required fields'
        ];

        header('Content-Type: application/json');
        echo json_encode($response);
        die();
    }

    // Prepare the SQL statement
    $stmt = $pdo->prepare('INSERT INTO user_basket (user_id, product, quantity) VALUES (:user_id, :product, :quantity)');

    // Bind the parameters
    $stmt->bindParam(':user_id', $requestData['user_id']);
    $stmt->bindParam(':product', $requestData['product']);
    $stmt->bindParam(':quantity', $requestData['quantity']);

    // Execute the query
    try {
        $stmt->execute();

        $response = [
            'status' => 'success',
            'message' => 'Item added to user basket successfully'
        ];

        header('Content-Type: application/json');
        echo json_encode($response);
    } catch (PDOException $e) {
        $response = [
            'status' => 'error',
            'message' => 'Query failed: ' . $e->getMessage()
        ];

        header('Content-Type: application/json');
        echo json_encode($response);
    }
}


// Insert a new item into the user_delivery table
function postUserDelivery($pdo) {
    // Get the request payload
    $requestData = json_decode(file_get_contents('php://input'), true);

    // Validate the required fields
    if (
        empty($requestData['user_id']) ||
        empty($requestData['delivery_day']) ||
        empty($requestData['delivery_period']) ||
        empty($requestData['address']) ||
        empty($requestData['phone']) ||
        empty($requestData['subscription_period'])
    ) {
        $response = [
            'status' => 'error',
            'message' => 'Missing required fields'
        ];

        header('Content-Type: application/json');
        echo json_encode($response);
        die();
    }

    // Prepare the SQL statement
    $stmt = $pdo->prepare('INSERT INTO user_delivery (user_id, delivery_day, delivery_period, address, phone, subscription_period) VALUES (:user_id, :delivery_day, :delivery_period, :address, :phone, :subscription_period)');

    // Bind the parameters
    $stmt->bindParam(':user_id', $requestData['user_id']);
    $stmt->bindParam(':delivery_day', $requestData['delivery_day']);
    $stmt->bindParam(':delivery_period', $requestData['delivery_period']);
    $stmt->bindParam(':address', $requestData['address']);
    $stmt->bindParam(':phone', $requestData['phone']);
    $stmt->bindParam(':subscription_period', $requestData['subscription_period']);

    // Execute the query
    try {
        $stmt->execute();

        $response = [
            'status' => 'success',
            'message' => 'Delivery details added successfully'
        ];

        header('Content-Type: application/json');
        echo json_encode($response);
    } catch (PDOException $e) {
        $response = [
            'status' => 'error',
            'message' => 'Query failed: ' . $e->getMessage()
        ];

        header('Content-Type: application/json');
        echo json_encode($response);
    }
}

?>
