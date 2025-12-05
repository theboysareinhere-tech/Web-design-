<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ECU Services</title>

<!-- This should be your main site stylesheet (NOT services.css) -->
<link rel="stylesheet" href="style.css">

<!-- Optional page-only stylesheet -->
<link rel="stylesheet" href="style.css?v=1.2">

    <link rel="stylesheet" href="./responsive.css">
</head>

<body>

<!-- ✅ Correct: DO NOT wrap header.php inside another <header> -->
<?php include 'header.php'; ?>

<header class="services-header">
    <h1>Our ECU & Automotive Electronics Services</h1>
    <p>Professional diagnostics, tuning, repairs & electronic programming.</p>
</header>

<section class="services-container">

    <div class="service-card">
        <h2>ECU Diagnostics & Troubleshooting</h2>
        <p class="price">$60</p>
        <p class="time">Time: 45 minutes</p>
        <p class="desc">Comprehensive diagnostics including DTC scanning, live data monitoring, and sensor/electrical issue detection.</p>
        <a href="book.php?service_id=1" class="book-btn">Book Now</a>

    </div>

    <div class="service-card">
        <h2>ECU Programming & Reprogramming</h2>
        <p class="price">$120</p>
        <p class="time">Time: 1–2 hours</p>
        <p class="desc">OEM-level programming including firmware updates, injector coding, module coding, and immobilizer pairing.</p>
        <a href="book.php?service_id=2" class="book-btn">Book Now</a>
    </div>

    <div class="service-card">
        <h2>Performance ECU Tuning (Stage 1–3)</h2>
        <p class="price">From $250</p>
        <p class="time">Time: 1–3 hours</p>
        <p class="desc">Custom tuning for increased horsepower, torque, throttle response and limiter calibration.</p>
        <a href="book.php?service_id=3" class="book-btn">Book Now</a>
    </div>

    <div class="service-card">
        <h2>ECU Repair & Component Servicing</h2>
        <p class="price">$150 – $300</p>
        <p class="time">Time: 2–48 hours</p>
        <p class="desc">Repairs damaged ECUs including board damage, water issues, and CAN communication faults.</p>
        <a href="book.php?service_id=4" class="book-btn">Book Now</a>
    </div>

    <div class="service-card">
        <h2>ECU Replacement & Cloning</h2>
        <p class="price">$180</p>
        <p class="time">Time: 1–2 hours</p>
        <p class="desc">Complete cloning of ECU data including VIN, immobilizer, and maps for plug-and-play setup.</p>
        <a href="book.php?service_id=5" class="book-btn">Book Now</a>
    </div>

    <div class="service-card">
        <h2>Advanced Module Diagnostics</h2>
        <p class="price">$80</p>
        <p class="time">Time: 60 minutes</p>
        <p class="desc">Diagnostics for ABS modules, SRS/airbag ECUs, transmission controllers, and BCM units.</p>
        <a href="book.php?service_id=6" class="book-btn">Book Now</a>
    </div>

    <div class="service-card">
        <h2>Performance Hardware Calibration</h2>
        <p class="price">$200</p>
        <p class="time">Time: 1–2 hours</p>
        <p class="desc">Recalibration for turbo upgrades, injectors, high-flow intakes, exhaust systems, and intercoolers.</p>
        <a href="book.php?service_id=7" class="book-btn">Book Now</a>
    </div>

    <div class="service-card">
        <h2>Sensor & Wiring Diagnostics</h2>
        <p class="price">$70</p>
        <p class="time">Time: 30–90 minutes</p>
        <p class="desc">Testing and troubleshooting MAF/MAP/O2 sensors, wiring faults, ground issues, and CAN-BUS communication.</p>
        <a href="book.php?service_id=8" class="book-btn">Book Now</a>
    </div>

    <div class="service-card">
        <h2>Security & Anti-Theft Programming</h2>
        <p class="price">$90</p>
        <p class="time">Time: 30–60 minutes</p>
        <p class="desc">Key programming, immobilizer pairing, ECU locking/unlocking, and anti-theft resets.</p>
        <a href="book.php?service_id=9" class="book-btn">Book Now</a>
    </div>

    <div class="service-card">
        <h2>Custom Electronic Features & Coding</h2>
        <p class="price">$60 – $150</p>
        <p class="time">Time: 30–90 minutes</p>
        <p class="desc">Enabling hidden features, cluster coding, launch control setups, and custom electronic configurations.</p>
        <a href="book.php?service_id=10" class="book-btn">Book Now</a>
    </div>

</section>

</body>
</html>
