<link rel="stylesheet" href="./responsive.css">
<?php
session_start();
require 'db.php';

// Make sure user is logged in
if (!isset($_SESSION['id'])) {
    die("User not logged in.");
}

$user_id = $_SESSION['id'];

// Get POSTed cart JSON
if (!isset($_POST['cart'])) {
    die("No cart data received.");
}

$cart = json_decode($_POST['cart'], true);
if (!$cart || count($cart) == 0) {
    die("Cart is empty.");
}

// Calculate total amount
$total = 0;
foreach ($cart as $item) {
    $total += $item['price'] * $item['qty'];
}

try {
    $conn->beginTransaction();

    // Insert into purchases
    $stmt = $conn->prepare("INSERT INTO purchases (user_id, total_amount) VALUES (:user_id, :total)");
    $stmt->execute([
        ':user_id' => $user_id,
        ':total' => $total
    ]);
    $purchase_id = $conn->lastInsertId();

    // Insert items
    $stmt_item = $conn->prepare("INSERT INTO purchase_items 
        (purchase_id, product_id, quantity, price_each) 
        VALUES (:purchase_id, :product_id, :qty, :price_each)");

    foreach ($cart as $item) {
        $stmt_item->execute([
            ':purchase_id' => $purchase_id,
            ':product_id' => $item['product_id'],
            ':qty' => $item['qty'],
            ':price_each' => $item['price']
        ]);
    }

    $conn->commit();

    echo json_encode([
        'success' => true,
        'message' => 'Purchase saved successfully.',
        'purchase_id' => $purchase_id
    ]);

} catch (PDOException $e) {
    $conn->rollBack();
    echo json_encode([
        'success' => false,
        'message' => 'Error saving purchase: ' . $e->getMessage()
    ]);
}
?>
