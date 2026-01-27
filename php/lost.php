<?php 
include "db.php";

$results_per_page = 2;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $results_per_page;

$total_sql = "SELECT COUNT(*) as total
              FROM posts 
              WHERE type = 1 AND is_found = 0";

$total_result = $conn->query($total_sql);
$total_row = $total_result->fetch_assoc();
$total_posts = $total_row['total'];
$total_pages = ceil($total_posts / $results_per_page);

$sql = "SELECT id, title, image, number, description, type, user_id 
        FROM posts 
        WHERE type = 1 AND is_found = 0
        ORDER BY id DESC 
        LIMIT $results_per_page OFFSET $offset";
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
        <h1>Sendet E Humbura</h1>
        <p>Na ndihmoni të ribashkojmë njerëzit me sendet e tyre të humbura.</p>
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
      <?php if ($total_pages > 1): ?>
        <div style="display: flex; justify-content: center;">
            <div class="pagination">
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <?php if ($i == $page): ?>
                        <a href="?page=<?php echo $i; ?>" class="active"><?php echo $i; ?></a>
                    <?php else: ?>
                        <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    <?php endif; ?>
                <?php endfor; ?>
            </div>
        </div>
      <?php endif; ?>
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
