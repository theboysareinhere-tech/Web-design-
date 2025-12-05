<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Power ECU - Products</title>

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <!-- External CSS -->
  <link rel="stylesheet" href="style_prod.css" />

    <link rel="stylesheet" href="./responsive.css">
</head>
<body>

  <?php include 'header.php'; ?>

  <section id="products">
    <h2 class="section-title fade-up">Our Products</h2>

    <div class="container fade-up">
      <div class="cards">
        
        <div class="card fade-up">
          <img src="images/piggyback.webp" alt="ECU Units">
          <h3>ECU Units</h3>
          <p>OEM, refurbished, standalone, and piggyback ECUs.</p>
          <a href="product_customize.html?product=ECU%20Units" class="price-btn">Starting at $120</a>
        </div>

        <div class="card fade-up">
          <img src="images/KESS3_OBD_Bench.webp" alt="Tuning Tools">
          <h3>Tuning Tools</h3>
          <p>KESS3, K-TAG, Autotuner, PCMFlash, BitBox, and more.</p>
          <a href="product_customize.html?product=Tuning%20Tools" class="price-btn">Starting at $220</a>
        </div>

        <div class="card fade-up">
          <img src="images/wire.webp" alt="Bench Tools">
          <h3>Bench & Boot Tools</h3>
          <p>BDM frames, probes, breakout boxes, PSU units.</p>
          <a href="product_customize.html?product=Bench%20Tools" class="price-btn">Starting at $75</a>
        </div>

        <!-- New Product 1 -->
        <div class="card fade-up">
          <img src="images/ecu Acc.webp" alt="ECU Accessories">
          <h3>ECU Accessories</h3>
          <p>Cables, connectors, adapters, and other ECU add-ons.</p>
          <a href="product_customize.html?product=ECU%20Accessories" class="price-btn">Starting at $40</a>
        </div>

      </div>
    </div>
  </section>

  <footer>
      <p>© 2025 Power ECU. All Rights Reserved.</p>
  </footer>

  <!-- Animation JS -->
  <script src="anim.js"></script>

</body>
</html>

