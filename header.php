<link rel="stylesheet" href="./responsive.css">
<?php
// header.php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once "config.php";

// If logged in, try to ensure we have up-to-date user info (so header shows fresh name/image)
$header_username = null;
$header_email = null;
$header_profile_image = "images/default.png";

if (!empty($_SESSION['id'])) {
    $uid = $_SESSION['id'];

    $sql = "SELECT username, email, profile_image FROM users WHERE id = ?";
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $uid);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $db_username, $db_email, $db_profile_image);
        if (mysqli_stmt_fetch($stmt)) {
            $header_username = $db_username;
            $header_email = $db_email;
            if (!empty($db_profile_image)) {
                $header_profile_image = "images/" . htmlspecialchars($db_profile_image);
            }
        }
        mysqli_stmt_close($stmt);
    }
}
?>

<header class="main-header">
  <div class="header-left">
    <div class="logo">
      <a href="index.php" style="display:flex;align-items:center;text-decoration:none;color:inherit;">
        <img src="images/logo.png" alt="Power ECU Logo" style="height:40px;margin-right:10px;">
        <h2 style="margin:0;font-size:18px;">Power ECU</h2>
      </a>
    </div>
  </div>

  <nav class="navbar">
    <ul class="nav-links">
      <li><a href="index.php">Home</a></li>
      <li><a href="product_index.php">Products</a></li>
      <li><a href="services_index.php">Services</a></li>
      <li><a href="contact.php">Contact Us</a></li>
    </ul>
  </nav>

  <div class="icons">
      <a href="cart.html"><i class="fas fa-shopping-cart"></i></a>

      <?php if (!empty($_SESSION['id']) && !empty($header_username)): ?>
        <!-- Account icon + dropdown when logged in -->
        <div class="account-container" id="accountContainer">
          <button class="account-trigger" id="accountTrigger" aria-expanded="false" aria-haspopup="true">
            <img src="<?php echo $header_profile_image; ?>" alt="Profile" class="account-thumb">
          </button>

          <div class="account-dropdown" id="accountDropdown" role="menu" aria-hidden="true">
            <div class="account-top">
              <img src="<?php echo $header_profile_image; ?>" alt="Profile" class="account-thumb-lg">
              <div class="account-meta">
                <div class="account-name"><?php echo htmlspecialchars($header_username); ?></div>
                <div class="account-email"><?php echo htmlspecialchars($header_email); ?></div>
              </div>
            </div>

            <div class="account-actions">
              <a href="account.php" class="dropdown-link">My Account</a>
              <a href="settings.php" class="dropdown-link">Account Settings</a>
              <a href="logout.php" class="dropdown-link logout-link">Logout</a>
            </div>
          </div>
        </div>
      <?php else: ?>
        <!-- Not logged in: show generic user link -->
        <a href="login_page-1.php" class="account-icon">
          <i class="fas fa-user-circle"></i>
        </a>
      <?php endif; ?>

      <div class="menu-toggle" id="menu-toggle"><i class="fas fa-bars"></i></div>
  </div>
</header>

<!-- Header CSS (place into your main stylesheet or copy into a header-specific stylesheet) -->
<style>
/* Minimal header/account styles — merge into your style.css */
.account-container { position: relative; display: inline-block; }
.account-trigger { background: transparent; border: 0; padding: 0; cursor: pointer; }
.account-thumb { width:40px; height:40px; border-radius:50%; object-fit:cover; border:2px solid #eee; }
.account-dropdown {
  position: absolute;
  right: 0;
  top: 52px;
  width: 260px;
  background: #fff;
  border-radius: 10px;
  box-shadow: 0 8px 24px rgba(10,20,40,0.15);
  padding: 12px;
  display: none;
  z-index: 999;
}
.account-top { display:flex; gap:10px; align-items:center; padding-bottom:10px; border-bottom:1px solid #f1f4f8; }
.account-thumb-lg { width:56px; height:56px; border-radius:50%; object-fit:cover; border:2px solid #f4f6fb; }
.account-meta { font-family: 'Poppins', sans-serif; }
.account-name { font-weight:600; color:#0b1a73; }
.account-email { font-size:13px; color:#666; margin-top:2px; }
.account-actions { display:flex; flex-direction:column; gap:8px; margin-top:10px; }
.dropdown-link { text-decoration:none; padding:8px 10px; border-radius:8px; display:block; color:#0b1a73; font-weight:600; background:#f6f8ff; text-align:center; }
.dropdown-link.logout-link { background:#fff0f0; color:#b02a37; }
@media (max-width:700px){
  .account-dropdown { right: 8px; top: 60px; width: 220px; }
}
</style>

<!-- Header JS: toggles the dropdown; put this just before </body> if header.php is at top -->
<script>
document.addEventListener('DOMContentLoaded', function(){
  const trigger = document.getElementById('accountTrigger');
  const dropdown = document.getElementById('accountDropdown');
  const container = document.getElementById('accountContainer');

  if (!trigger) return;

  trigger.addEventListener('click', (e) => {
    e.stopPropagation();
    const isOpen = dropdown.style.display === 'block';
    dropdown.style.display = isOpen ? 'none' : 'block';
    trigger.setAttribute('aria-expanded', String(!isOpen));
    dropdown.setAttribute('aria-hidden', String(isOpen));
  });

  // close when clicking outside
  document.addEventListener('click', (e) => {
    if (!container.contains(e.target)) {
      dropdown.style.display = 'none';
      trigger.setAttribute('aria-expanded', 'false');
      dropdown.setAttribute('aria-hidden', 'true');
    }
  });

  // close with ESC
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
      dropdown.style.display = 'none';
      if (trigger) trigger.setAttribute('aria-expanded', 'false');
      if (dropdown) dropdown.setAttribute('aria-hidden', 'true');
    }
  });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function(){
  const trigger = document.getElementById('accountTrigger');
  const dropdown = document.getElementById('accountDropdown');
  const container = document.getElementById('accountContainer');

  if (!trigger || !dropdown || !container) return;

  trigger.addEventListener('click', (e) => {
    e.stopPropagation();
    const isOpen = dropdown.classList.contains('open');
    if (isOpen) {
      dropdown.classList.remove('open');
      trigger.setAttribute('aria-expanded', 'false');
      dropdown.setAttribute('aria-hidden', 'true');
    } else {
      dropdown.classList.add('open');
      trigger.setAttribute('aria-expanded', 'true');
      dropdown.setAttribute('aria-hidden', 'false');
    }
  });

  // close when clicking outside
  document.addEventListener('click', (e) => {
    if (!container.contains(e.target)) {
      dropdown.classList.remove('open');
      trigger.setAttribute('aria-expanded', 'false');
      dropdown.setAttribute('aria-hidden', 'true');
    }
  });

  // close with ESC
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
      dropdown.classList.remove('open');
      trigger.setAttribute('aria-expanded', 'false');
      dropdown.setAttribute('aria-hidden', 'true');
    }
  });
});
</script>

