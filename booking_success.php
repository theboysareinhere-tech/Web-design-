<?php
include 'service_db.php';

if (!isset($_GET['booking_id'])) {
    die("Invalid booking.");
}

$booking_id = intval($_GET['booking_id']);

// Corrected SQL: use b.id instead of b.booking_id
$query = $conn->prepare("
    SELECT b.*, s.service_name, s.price
    FROM bookings b
    JOIN services s ON b.service_id = s.service_id
    WHERE b.id = ?
");
$query->bind_param("i", $booking_id);
$query->execute();
$result = $query->get_result();

if ($result->num_rows == 0) {
    die("Booking not found.");
}

$booking = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <titl
    <link rel="stylesheet" href="./responsive.css">
e>Booking Confirmed</title>
    <link rel="stylesheet" href="services.css">
</head>

<body>

<div class="booking-container">
    <h1>Booking Confirmed!</h1>

    <div class="booking-card">
        <p><strong>Service:</strong> <?= htmlspecialchars($booking['service_name']) ?></p>
        <p><strong>Price:</strong> $<?= htmlspecialchars($booking['price']) ?></p>
        <p><strong>Customer Name:</strong> <?= htmlspecialchars($booking['customer_name']) ?></p>
        <p><strong>Phone:</strong> <?= htmlspecialchars($booking['phone']) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($booking['email']) ?></p>
        <p><strong>Date:</strong> <?= htmlspecialchars($booking['appointment_date']) ?></p>
        <p><strong>Time:</strong> <?= htmlspecialchars($booking['appointment_time']) ?></p>
        <?php if (isset($booking['notes']) && !empty($booking['notes'])): ?>
            <p><strong>Notes:</strong> <?= htmlspecialchars($booking['notes']) ?></p>
        <?php endif; ?>
    </div>

    <a href="services_index.php" class="book-btn">Back to Services</a>
</div>

</body>
</html>

