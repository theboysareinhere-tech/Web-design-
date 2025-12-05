<?php
session_start(); // Start session at the very top

include 'service_db.php'; // Database connection

// Check if user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: login_page-1.php?error=login_required");
    exit();
}

// Check if service_id is provided
if (!isset($_GET['service_id'])) {
    die("Service not selected.");
}

$service_id = intval($_GET['service_id']);

// Fetch service details
$query = $conn->prepare("SELECT * FROM services WHERE service_id = ?");
$query->bind_param("i", $service_id);
$query->execute();
$result = $query->get_result();

if ($result->num_rows == 0) {
    die("Service not found.");
}

$service = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta charset="UTF-8">
    <ti
    <link rel="stylesheet" href="./responsive.css">
tle>Book Service</title>
    <link rel="stylesheet" href="style.css?v=1.2">
</head>
<body>
    <button class="back-btn" onclick="history.back()">← Back</button>

    <div class="booking-container">
        <h1>Book: <?= htmlspecialchars($service['service_name']) ?></h1>

        <div class="booking-card">
            <p><strong>Price:</strong> <?= htmlspecialchars($service['price']) ?></p>
            <p><strong>Estimated Time:</strong> <?= htmlspecialchars($service['duration']) ?></p>
            <p><?= htmlspecialchars($service['description']) ?></p>
        </div>

        <form action="submit_booking.php" method="POST" class="booking-form">
            <input type="hidden" name="service_id" value="<?= $service_id ?>">

            <label>Full Name:</label>
            <input type="text" name="customer_name" required>

            <label>Phone:</label>
            <input type="text" name="phone" required>

            <label>Email:</label>
            <input type="email" name="email" required>

            <label>Appointment Date:</label>
            <input type="date" name="appointment_date" required>

            <label>Appointment Time:</label>
            <input type="time" name="appointment_time" required>

            <label>Additional Notes (optional):</label>
            <textarea name="notes" placeholder="Describe any special requests..."></textarea>

            <button type="submit" class="book-btn">Confirm Booking</button>
        </form>
    </div>
</body>
</html>
