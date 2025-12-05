<link rel="stylesheet" href="./responsive.css">
<?php
session_start();
include 'service_db.php'; // Must contain $conn (mysqli)


// ------------------------
// 1. CHECK LOGIN
// ------------------------
if (!isset($_SESSION['id'])) {
    header("Location: login_page-1.php?error=login_required");
    exit();
}

$user_id = $_SESSION['id'];


// ------------------------
// 2. VALIDATE FORM INPUTS
// ------------------------
$required = ['service_id', 'customer_name', 'phone', 'email', 'appointment_date', 'appointment_time'];

foreach ($required as $field) {
    if (!isset($_POST[$field]) || empty($_POST[$field])) {
        die("Missing required fields: " . $field);
    }
}

$service_id        = intval($_POST['service_id']);
$customer_name     = trim($_POST['customer_name']);
$phone             = trim($_POST['phone']);
$email             = trim($_POST['email']);
$appointment_date  = trim($_POST['appointment_date']);
$appointment_time  = trim($_POST['appointment_time']);
$notes             = isset($_POST['notes']) ? trim($_POST['notes']) : null;


// ------------------------
// 3. CHECK IF SERVICE EXISTS
// ------------------------
$checkService = $conn->prepare("SELECT service_id FROM services WHERE service_id = ?");
$checkService->bind_param("i", $service_id);
$checkService->execute();
$serviceCheckResult = $checkService->get_result();

if ($serviceCheckResult->num_rows === 0) {
    die("Service does not exist.");
}
$checkService->close();


// ------------------------
// 4. PREVENT DOUBLE BOOKING
// ------------------------
$checkBooking = $conn->prepare("
    SELECT * FROM bookings
    WHERE user_id = ? AND appointment_date = ? AND appointment_time = ?
");
$checkBooking->bind_param("iss", $user_id, $appointment_date, $appointment_time);
$checkBooking->execute();
$existingBooking = $checkBooking->get_result();

if ($existingBooking->num_rows > 0) {
    die("You already booked a service at this time.");
}
$checkBooking->close();


// ------------------------
// 5. INSERT BOOKING
// ------------------------
$insert = $conn->prepare("
    INSERT INTO bookings (user_id, service_id, customer_name, phone, email, appointment_date, appointment_time, notes)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)
");
$insert->bind_param("iissssss",
    $user_id,
    $service_id,
    $customer_name,
    $phone,
    $email,
    $appointment_date,
    $appointment_time,
    $notes
);

if ($insert->execute()) {

    $newID = $conn->insert_id;
    $insert->close();

    header("Location: booking_success.php?booking_id=" . $newID);
    exit();

} else {
    die("Database Error: " . $insert->error);
}
?>
