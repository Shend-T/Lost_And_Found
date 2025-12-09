<?php
include 'db.php';

// if (!(isset($_COOKIE["user_username"]) and isset($_COOKIE["user_id"]))) {
//     header("Location: login.php");
//     exit();
// }

// if (isset($_POST["sign_out"])) {
//   setcookie("user_username", "", time() - 3600); 
//   setcookie("user_id", "", time() - 3600); 
//   header("Refresh: 0");
//   exit();
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UBT - Lost And Found</title>

  <!-- === Title Icon === -->
  <link rel="icon" href="../media/favicon.ico" type="image/x-icon" />

  <!-- === CSS Links === -->
  <link rel="stylesheet" href="../css/index.css" />
  <link
    href="https://fonts.googleapis.com/css?family=Ubuntu:regular,bold&subset=Latin"
    rel="stylesheet"
  />

  <link rel="stylesheet" href="../css/home.css">
   
  <!-- Kod nga: https://stackoverflow.com/a/42333464 -->
   <!-- Arysja, per te referencuar nav.php ne cdo file pa pas nevoj te shenohet 100 her -->
  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
</head>
<body>
    <!-- Kod nga: https://stackoverflow.com/a/42333464 -->
    <div id="nav-placeholder"></div>

    <div class="container">
        <!-- Hero Section -->
        <section class="hero">
            <div class="hero-content">
                <h1>Lost Something? Found Something?</h1>
                <p class="hero-subtitle">We help reunite lost items with their owners. Report lost or found items and browse listings to find what you're looking for.</p>
                <div class="hero-buttons">
                    <a href="lost.php" class="btn btn-primary">Report Lost Item</a>
                    <a href="found.php" class="btn btn-secondary">Report Found Item</a>
                </div>
            </div>
            <div class="hero-image">
                <img src="../media/human.jpg" alt="Lost and Found">
            </div>
        </section>

        <!-- Stats Section -->
        <section class="stats">
            <div class="stat-card">
                <div class="stat-number">1,245</div>
                <div class="stat-label">Items Found</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">856</div>
                <div class="stat-label">Items Reunited</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">389</div>
                <div class="stat-label">Active Listings</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">2,150+</div>
                <div class="stat-label">Registered Users</div>
            </div>
        </section>

        <!-- How It Works Section -->
        <section class="how-it-works">
            <h2>How It Works</h2>
            <div class="steps">
                <div class="step">
                    <div class="step-number">1</div>
                    <h3>Report</h3>
                    <p>Report a lost or found item with details and photos. The more information you provide, the easier it is to match items.</p>
                </div>
                <div class="step">
                    <div class="step-number">2</div>
                    <h3>Browse</h3>
                    <p>Search through listings or browse by category. Filter by location, date, or item type to find what you're looking for.</p>
                </div>
                <div class="step">
                    <div class="step-number">3</div>
                    <h3>Connect</h3>
                    <p>Contact the owner or finder through our secure messaging system. Verify ownership and arrange a safe meeting place.</p>
                </div>
                <div class="step">
                    <div class="step-number">4</div>
                    <h3>Reunite</h3>
                    <p>Successfully reunite items with their owners! Mark items as returned and share your success story with our community.</p>
                </div>
            </div>
        </section>

        <!-- Recent Listings Section -->
        <!-- === HEREEEEEE ==== -->
        <section class="recent-listings">
            <h2>Recent Listings</h2>
            <div class="listings-grid">
                <div class="listing-card found">
                    <div class="listing-badge found-badge">E GJETUR</div>
                    <img src="../media/image_256.png" alt="Lost Item" class="listing-image">
                    <div class="listing-info">
                        <h3>Kulete e humbur</h3>
                        <p class="listing-location">📍 UBT Dukagjini Salla 130</p>
                        <p class="listing-date">30 Nentor 2025</p>
                        <p class="listing-description">Nje kulet e humbur ne sallen 130 ne rreshtin e pare.</p>
                    </div>
                    <a href="details.php" class="listing-link">View Details</a>
                </div>
            </div>
            <div class="view-all">
                <a href="lost.php" class="btn btn-outline">View All Listings</a>
            </div>
        </section>

        <!-- Features Section -->
        <section class="features">
            <h2>Why Choose Us?</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">🔍</div>
                    <h3>Easy Search</h3>
                    <p>Powerful search filters help you find items quickly by location, category, and date.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📸</div>
                    <h3>Photo Verification</h3>
                    <p>Upload photos of items for better identification and verification of ownership.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🔒</div>
                    <h3>Secure Messaging</h3>
                    <p>Safe and private communication between users to verify details and arrange pickup.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">⚡</div>
                    <h3>Quick Notifications</h3>
                    <p>Get instant alerts when new matching items are posted or when someone contacts you.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🌍</div>
                    <h3>Local Focus</h3>
                    <p>Connect with people in your area. Perfect for campus and community lost & found.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">✅</div>
                    <h3>Verified Users</h3>
                    <p>Trusted community with verified accounts to ensure safe and legitimate transactions.</p>
                </div>
            </div>
        </section>

    </div>

    <footer class="site-footer">
      <div class="footer-container">
        <!-- Center - Copyright & Social -->
        <div class="footer-section footer-center">
          <p class="footer-copyright">
            © Copyright 2025 UBT Lost and Found<br />
            All Rights Reserved
          </p>
        </div>

        <!-- Contact -->
        <div class="footer-section footer-contact">
          <h1>Contact</h1>
          <p><span>Tel:</span> +383 XX XXX XXX</p>
          <p><span>Email:</span> contact@ubt-uni.net</p>
        </div>
      </div>
    </footer>

  <!-- <form action="" method="POST">
    <button type="submit" name="sign_out">Sign Out</button>
  </form>

    <a href="user.php" class="button">User</a> -->

    <script>
      $(function(){
        $("#nav-placeholder").load("nav.php");
      });
    </script>
</body>
