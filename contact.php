<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Power ECU - Contact</title>

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <!-- Header CSS (keep header styles authoritative) -->
  <link rel="stylesheet" href="header.css" />

  <!-- Contact page CSS (scoped to .contact-page to avoid overriding header) -->
  <link rel="stylesheet" href="style_contact.css" />

    <link rel="stylesheet" href="./responsive.css">
</head>
<body>

<?php include 'header.php'; ?>

<main class="contact-page">

  <section class="contact-wrap">
    <div class="container">

      <!-- ===== Left Side: Contact Form ===== -->
      <div class="form-card">
        <h1>Contact Our Team</h1>
        <p>Got questions? Our friendly team is ready to help you. Fill out the form below and we’ll get back to you fast.</p>

        <form action="send_mail.php" method="POST" id="contactForm">

          <div class="row">
            <div class="field">
              <input type="text" name="first_name" required placeholder=" ">
              <label>First Name</label>
            </div>
            <div class="field">
              <input type="text" name="last_name" required placeholder=" ">
              <label>Last Name</label>
            </div>
          </div>

          <div class="field">
            <input type="email" name="email" required placeholder=" ">
            <label>Email</label>
          </div>

          <div class="field">
            <input type="tel" name="phone" placeholder=" ">
            <label>Phone Number</label>
          </div>

          <div class="field textarea-field">
            <textarea name="message" required placeholder=" "></textarea>
            <label>Message</label>
          </div>

          <h3>Services</h3>
          <div class="checkboxes">
            <label><input type="checkbox" name="services[]" value="Website design"><span></span> Website design</label>
            <label><input type="checkbox" name="services[]" value="Content creation"><span></span> Content creation</label>
            <label><input type="checkbox" name="services[]" value="UX design"><span></span> UX design</label>
            <label><input type="checkbox" name="services[]" value="Strategy & consulting"><span></span> Strategy & consulting</label>
            <label><input type="checkbox" name="services[]" value="User research"><span></span> User research</label>
            <label><input type="checkbox" name="services[]" value="Other"><span></span> Other</label>
          </div>

          <button type="submit" class="submit-btn">Send Message <i class="fas fa-paper-plane"></i></button>
        </form>
      </div>

      <!-- ===== Right Side: Contact Info ===== -->
      <aside class="info-card">
        <div class="info-section">
          <i class="fas fa-phone-alt"></i>
          <h3>Call Us</h3>
          <p>Mon–Fri from 8am to 5pm</p>
          <a href="tel:+15550000000">+1 (555) 000-0000</a>
        </div>

        <div class="info-section">
          <i class="fas fa-map-marker-alt"></i>
          <h3>Visit Us</h3>
          <p>Chat to us in person at our Melbourne HQ</p>
          <a href="#">100 Smith Street, Collingwood VIC 3066</a>
        </div>
      </aside>

    </div> <!-- .container -->
  </section>

  <!-- Success Popup -->
  <div id="successPopup" class="popup" aria-hidden="true">
    <div class="popup-box">
      <h2>Message Sent!</h2>
      <p>Your message has been successfully sent. We will get back to you shortly.</p>
    </div>
  </div>

</main>

<footer>
  <p>© 2025 Power ECU. All Rights Reserved.</p>
</footer>

<!-- Optional JS (unchanged) -->
<script src="send_contact.js"></script>
</body>
</html>
