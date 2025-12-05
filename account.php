<?php
session_start();
require_once "config.php";

// Require login
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || empty($_SESSION['id'])) {
    header("Location: login_page-1.html");
    exit();
}

$user_id = (int) $_SESSION['id'];

/* ---------------------------
   Fetch user profile
---------------------------- */
$sql = "SELECT username, email, profile_image, join_date FROM users WHERE id = ?";
if ($stmt = mysqli_prepare($link, $sql)) {
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $username, $email, $profile_image_db, $join_date);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
}

$profile_image = $profile_image_db ? "images/" . $profile_image_db : "images/default.png";

/* ---------------------------
   Calculate total spent
---------------------------- */
$total_spent = 0;
$total_sql = $link->query("SELECT SUM(total) AS spent FROM purchases WHERE user_id = $user_id");
if ($row = $total_sql->fetch_assoc()) {
    $total_spent = $row["spent"] ?? 0;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta charset="utf-8">
  <titl
    <link rel="stylesheet" href="./responsive.css">
e>My Account — Power ECU</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'header.php'; ?>

<section class="account-container" style="padding:30px; display:flex; justify-content:center;">
  <div class="profile-card" style="max-width:820px; width:100%; background:#fff; border-radius:12px; padding:20px; box-shadow:0 6px 18px rgba(10,20,40,0.06);">

      <!-- Profile Header -->
      <div style="display:flex; gap:20px; align-items:center;">
        <img src="<?php echo $profile_image; ?>" style="width:120px;height:120px;border-radius:12px;object-fit:cover;border:2px solid #eee;">

        <div>
          <h2><?php echo htmlspecialchars($username); ?></h2>
          <p><?php echo htmlspecialchars($email); ?></p>
          <p><strong>Total Spent:</strong> $<?php echo number_format($total_spent,2); ?></p>
          <p><strong>Join Date:</strong> <?php echo date("F j, Y", strtotime($join_date)); ?></p>
        </div>
      </div>

      <hr style="margin:20px 0;">

      <!-- Purchase History -->
      <h3 style="color:#0b1a73;">Your Purchases</h3>

      <?php
      // Load all purchases
      $purchases = $link->query("SELECT * FROM purchases WHERE user_id = $user_id ORDER BY created_at DESC");
      ?>

      <?php if ($purchases->num_rows === 0): ?>
          <p>No purchases yet.</p>
      <?php else: ?>

          <?php while ($p = $purchases->fetch_assoc()): ?>
              <div class="purchase-block" style="background:#f5f7fa; padding:15px; border-radius:10px; margin-bottom:15px;">

                  <h3>
                      Order #<?= $p["id"] ?> —  
                      $<?= number_format($p["total"], 2) ?>
                  </h3>

                  <small><?= date("F j, Y, g:i a", strtotime($p["created_at"])) ?></small>

                  <?php
                  // Load the items for this order
                  $items = $link->query("
                      SELECT * FROM purchase_items
                      WHERE purchase_id = " . $p["id"]
                  );
                  ?>

                  <ul class="order-items" style="margin-top:10px; padding-left:20px;">
                      <?php while ($i = $items->fetch_assoc()): ?>
                          <li style="margin-bottom:12px;">
                              <img src="<?= htmlspecialchars($i["image"]) ?>" width="60"
                                   style="border-radius:6px; vertical-align:middle; margin-right:8px;">

                              <strong><?= htmlspecialchars($i["name"]) ?></strong><br>

                              Type: <?= htmlspecialchars($i["type"]) ?> |
                              Add-on: <?= htmlspecialchars($i["addon"]) ?><br>

                              Qty: <?= (int)$i["qty"] ?> |
                              Price: $<?= number_format($i["priceEach"], 2) ?> |
                              Total: $<?= number_format($i["total"], 2) ?>
                          </li>
                      <?php endwhile; ?>
                  </ul>

              </div>
          <?php endwhile; ?>

      <?php endif; ?>

  </div>
</section>

</body>
</html>
