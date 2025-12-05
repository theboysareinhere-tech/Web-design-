<link rel="stylesheet" href="./responsive.css">
<?php
// process_checkout.php
session_start();
header('Content-Type: application/json; charset=utf-8');
require_once "config.php";

// Require login
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || empty($_SESSION['id'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit;
}

$user_id = (int) $_SESSION['id'];

// Read JSON payload
$raw = file_get_contents('php://input');
if (!$raw) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'No data received']);
    exit;
}

$data = json_decode($raw, true);
if (json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid JSON']);
    exit;
}

// Validate minimal fields
$cart = $data['cart'] ?? null;
$total = $data['total'] ?? null;
$billing = $data['billing'] ?? [];

if (!is_array($cart) || count($cart) === 0 || !is_numeric($total)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid cart or total']);
    exit;
}

// For purchases.item_name: create a readable summary (first item or "Order: X items")
$item_names = array_map(function($it){
    return $it['name'] ?? ('product_'.$it['product_id'] ?? 'unknown');
}, $cart);

$item_name_summary = (count($item_names) === 1) ? $item_names[0] : implode(', ', array_slice($item_names,0,3)) . ((count($item_names)>3) ? '...' : '');

$mysqli = $link; // already from config.php

// Start transaction
$mysqli->begin_transaction();

try {
    // Insert into purchases
    $sql = "INSERT INTO purchases (item_name, user_id, purchase_date, total_amount)
            VALUES (?, ?, NOW(), ?)";
    $stmt = mysqli_prepare($mysqli, $sql);
    if (!$stmt) throw new Exception('Prepare purchases failed: ' . mysqli_error($mysqli));
    mysqli_stmt_bind_param($stmt, "sid", $item_name_summary, $user_id, $total);
    mysqli_stmt_execute($stmt);
    $purchase_id = mysqli_insert_id($mysqli);
    mysqli_stmt_close($stmt);

    // Insert purchase_items
    $sql2 = "INSERT INTO purchase_items (purchase_id, product_id, quantity, price_each)
             VALUES (?, ?, ?, ?)";
    $stmt2 = mysqli_prepare($mysqli, $sql2);
    if (!$stmt2) throw new Exception('Prepare purchase_items failed: ' . mysqli_error($mysqli));

    foreach ($cart as $it) {
        // Expecting fields: id (product_id), qty, priceEach
        $product_id = isset($it['id']) ? (int)$it['id'] : null;
        $qty = isset($it['qty']) ? (int)$it['qty'] : (isset($it['quantity']) ? (int)$it['quantity'] : 1);
        $price_each = isset($it['priceEach']) ? (float)$it['priceEach'] : (isset($it['price']) ? (float)$it['price'] : 0.0);

        // Null product_id is acceptable if product not in products table
        if ($product_id === null) {
            // store 0 for unknown product id
            $product_id = 0;
        }

        mysqli_stmt_bind_param($stmt2, "iiid", $purchase_id, $product_id, $qty, $price_each);
        mysqli_stmt_execute($stmt2);
        // you could check mysqli_stmt_affected_rows for each execute if desired
    }

    mysqli_stmt_close($stmt2);

    // Commit
    $mysqli->commit();

    // Return success and purchase id
    echo json_encode(['success' => true, 'purchase_id' => $purchase_id]);

} catch (Exception $e) {
    $mysqli->rollback();
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'DB error: ' . $e->getMessage()]);
    exit;
}
