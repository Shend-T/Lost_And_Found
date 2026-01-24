<?php 
include "db.php";

// Marrim id, nga url. Nese ska ateher vleren e merr 0( shiko if-in posht)
$post_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Shikojme se a eshte valid id-ja ne fjale
if ($post_id <= 0) {
  // die("Post ID nuk është valid!");

  // Nuk isha i sigurt se a me perdor die() apo veq me ndrru URL-in
  header("Location: index.php");
}

// Tash qe u sigurum qe id-ja esht valide, e marrim postin nga db
$sql = "SELECT * FROM posts WHERE id = " . intval($post_id); // intval sepse post_id llogaritet te jet string
$result = $conn->query($sql);

if (!$result || $result->num_rows === 0) {
  die("Post not found"); // 'Sanity' 'check'-i fundit, nese rastsisht user-i ka shkru url vet, per ni post qe nuk ekziston
}
$post = $result->fetch_assoc();

$imgInfo = getimagesizefromstring($post['image']);
$mime = $imgInfo['mime']; // marrim formatin e imazhit: "image/png", "image/jpeg", "image/webp", etj

// Pasi qe imazhi esht ruajtur si 'blob', e konvertojm ne imazh
$imageData = base64_encode($post['image']);
$imageSrc = "data:$mime;base64,$imageData"; // tash e kemi src-ne e imazhit
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
    <link rel="stylesheet" href="../css/details.css" />

    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
</head>
<body>
    <div class="container">
      <a href="index.php" class="back-button" id="backButton">Kthehu</a>

      <div class="detail-card">
        <div class="detail-image-container">
          <img 
            src="<?php echo $imageSrc; ?>"
            alt="<?php echo $post['title']; 
                  // alt's i kemi perdor per "SEO", edhe pse esht vetem projekt qe me probabilitet tmadh nuk do te behet publik. ?>"
            class="detail-image"
            id="detailImage" />
        </div>
        <div class="detail-content">
          <h1 class="detail-title" id="detailTitle"><?php echo $post['title'] ?></h1>
          <p class="detail-description" id="detailDescription">
            <?php echo $post['description'] ?>
          </p>

          <div class="detail-info-grid">
            <div class="detail-info-item">
              <div class="detail-info-label">Data e postimit</div>
              <div class="detail-info-value" id="detailDate"><?php echo $post['date'] ?></div>
            </div>

          </div>

          <div class="detail-contact">
            <div class="detail-contact-label" id="contactLabel">Kontakti</div>
            <div class="detail-contact-info" id="detailContact">
               +383 <?php echo $post['number'] ?>
            </div>
          </div>
        </div>
      </div>
    </div>
</body>
</html>