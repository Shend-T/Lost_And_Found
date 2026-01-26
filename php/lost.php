<?php 
include "db.php";
$sql = "SELECT id, title, image, number, description, type, user_id 
        FROM posts 
        WHERE type = 1 AND is_found = 0";
$result = $conn->query($sql);
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
      <div class="page-header">
        <h1>Lost Items</h1>
        <p>Help us reunite people with their lost belongings</p>
      </div>

      <div class="content-wrapper">
        <div class="main-content">
          <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                  <article class="item-card">
                    <div class="date-section"></div>
                    <div class="item-content">
                      <?php
                        // Get image info from blob
                        $imgInfo = getimagesizefromstring($row['image']);
                        $mime = $imgInfo['mime'];
                        
                        // Convert blob to base64
                        $imageData = base64_encode($row['image']);
                        $imageSrc = "data:$mime;base64,$imageData";
                        ?>
                      <img
                        src="<?php echo $imageSrc; ?>"
                        alt="<?php echo $row['title']; ?>"
                        class="item-image"
                      />
                      <div class="item-details">
                        <div>
                          <p class="item-title"><?php echo $row['title'] ?></p>
                          <p class="item-description"><?php echo $row['description'] ?></p>
                        </div>
                        <div class="item-contact">
                          <div class="contact-label">Kontakti</div>
                            <div class="contact-info">
                              +383 <?php echo $row['number'] ?>
                            </div>
                          <a href="details.php?id=<?= $row['id'] ?>" class="read-more">Shiko Detajet</a>
                        </div>
                      </div>
                    </div>
                  </article>
                <?php endwhile; ?>
            <?php else: ?>
              <h1>Nuk ka poste momentalisht.</h1>
            <?php endif; ?>
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
