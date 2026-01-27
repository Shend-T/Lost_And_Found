<?php
include "db.php";

// Shfaqim vetem 2( e kisha bo 5, por me shum me interesojke logjika e kodit / pra 2 vetem ne 
// 'production') poste, pasi qe kjo ben website-in me 'user-friendly'
$results_per_page = 2; // Sa poste duam ti paraqesim
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Ne url do te shtohet se tek cili 'page' jemi
$offset = ($page - 1) * $results_per_page;

// Marrim numrin total te posteve
$total_sql = "SELECT COUNT(*) as total
              FROM posts 
              WHERE type = 0 AND is_found = 0";

$total_result = $conn->query($total_sql);
$total_row = $total_result->fetch_assoc();
$total_posts = $total_row['total'];
$total_pages = ceil($total_posts / $results_per_page);

// echo "<script>alert('Total posts: $total_posts | Total pages: $total_pages')</script>";

// Na duhet ti marrim te gjitha postet( is_found=0, do te thot postet
// ku jane gjetur sendet e humbura)
$sql = "SELECT id, title, image, number, description, type, user_id 
        FROM posts 
        WHERE type = 0 AND is_found = 0
        ORDER BY id DESC 
        LIMIT $results_per_page OFFSET $offset"; // Postet ku is_found = 0, pasi qe postet e gjetura nuk ka nevoje t'i paraqesim
                                                 // Bejm offset per cdo page * results_per_page
        
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
    <link rel="stylesheet" href="../css/found.css" />

  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
  </head>
  <body>
    <div id="nav-placeholder"></div>
    <div class="container">
      <!-- Header -->
      <div class="page-header">
        <h1>Sendet E Gjetura</h1>
        <p>Artikuj të gjetur në kampus që presin të merren.</p>
      </div>

      <div class="content-wrapper">
        <div class="main-content">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                  <article class="item-card">
                    <div class="date-section"></div>
                    <div class="item-content">
                      <?php
                        $imgInfo = getimagesizefromstring($row['image']);
                        $mime = $imgInfo['mime'];
                        
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

            <!-- Kodi i komentuar ishte si baze -->
          <!-- <article class="item-card">
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
          </article> -->
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
    
    <!-- Navbar Enhancement Script -->
    <script>
      $(function(){
        $("#nav-placeholder").load("nav.php");
      });
    </script>
    
  </body>
</html>