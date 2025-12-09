<?php ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lost Items - UBT Lost And Found</title>

    <!-- === Title Icon === -->
    <link rel="icon" href="../media/favicon.ico" type="image/x-icon" />

    <!-- === CSS Links === -->
    <link rel="stylesheet" href="../css/index.css" />
    <link
      href="https://fonts.googleapis.com/css?family=Ubuntu:regular,bold&subset=Latin"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="../css/details.css" />

    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
</head>
<body>
    <div class="container">
      <a href="lost.php" class="back-button" id="backButton">Back</a>

      <div class="detail-card">
        <div class="detail-image-container">
          <img src="../media/image_256.png" alt="Item Image" class="detail-image" id="detailImage" />
        </div>
        <div class="detail-content">
          <h1 class="detail-title" id="detailTitle">Item Title</h1>
          <p class="detail-description" id="detailDescription">
            Item description will appear here.
          </p>

          <div class="detail-info-grid">
            <div class="detail-info-item">
              <div class="detail-info-label">Date</div>
              <div class="detail-info-value" id="detailDate">12 NOV 2025</div>
            </div>

          </div>

          <div class="detail-contact">
            <div class="detail-contact-label" id="contactLabel">Contact</div>
            <div class="detail-contact-info" id="detailContact">
               +383 XX XXX XXX
            </div>
          </div>
        </div>
      </div>
    </div>
</body>
</html>