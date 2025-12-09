<?php 

?>
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
    <link rel="stylesheet" href="../css/lost.css" />

    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
  </head>
  <body>
    <div id="nav-placeholder"></div>
    <div class="container">
      <!-- Page Header -->
      <div class="page-header">
        <h1>Lost Items</h1>
        <p>Help us reunite people with their lost belongings</p>
      </div>

      <!-- Main Content Wrapper -->
      <div class="content-wrapper">
        <!-- Main Content Area -->
        <div class="main-content">
          <!-- Item Card 1 -->
          <article class="item-card">
            <div class="date-section"></div>
            <div class="item-content">
              <img
                src="https://images.unsplash.com/photo-1582139329536-e7284fece509?w=400&h=300&fit=crop"
                alt="Lost Keys"
                class="item-image"
              />
              <div class="item-details">
                <div>
                  <p class="item-title">Lorem Ipsum Dolor Sit Amet</p>
                  <p class="item-description">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed
                    do eiusmod tempor incididunt ut labore et dolore magna
                    aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                    ullamco laboris.
                  </p>
                </div>
                <div class="item-contact">
                  <div class="contact-label">Contact</div>
                  <div class="contact-info">
                    user@student.ubt.edu • +383 XX XXX XXX
                  </div>
                  <a href="details.php" class="read-more">View Details</a>
                </div>
              </div>
            </div>
          </article>
        </div>
      </div>

      <!-- Pagination -->
      <div style="display: flex; justify-content: center;">
        <div class="pagination">
          <a href="lost.html?page=1" class="active">1</a>
          <!-- <a href="lost.html?page=2">2</a> -->
          <!-- <a href="lost.html?page=3">3</a> -->
          <!-- <a href="lost.html?page=4">4</a> -->
        </div>
      </div>
    </div>
    
    <!-- Navbar Enhancement Script -->
    <script>
      $(function(){
        $("#nav-placeholder").load("nav.php");
      });
    </script>
    
  </body>
</html>
