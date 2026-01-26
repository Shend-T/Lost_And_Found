<?php 
include "db.php";

if (!(isset($_COOKIE["user_username"]) and isset($_COOKIE["user_id"]))) {
    header("Location: login.php");
    exit();
}

$user_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($user_id != $_COOKIE["user_id"]) {
  header("Location: index.php");
}

$sql = "SELECT * FROM posts WHERE user_id = " . intval($user_id);
$result = $conn->query($sql);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_posts'])) {
  if (isset($_POST['found_posts'])) {
    foreach ($_POST['found_posts'] as $post_id) {
      $post_id = intval($post_id);

      $sql = "UPDATE posts SET is_found = 1 WHERE id = $post_id";
      $conn->query($sql);
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Lost Items - UBT Lost And Found</title>

    <!-- === Title Icon === -->
    <link rel="icon" href="../media/favicon.ico" type="image/x-icon" />

    <!-- === CSS Links === -->
    <link rel="stylesheet" href="../css/index.css" />
    <!-- Po i riperdori kto css file-a pasi qe kodi esht thuajse i njejt -->
    <link rel="stylesheet" href="../css/user.css">
    <link rel="stylesheet" href="../css/found.css" />
    <link
      href="https://fonts.googleapis.com/css?family=Ubuntu:regular,bold&subset=Latin"
      rel="stylesheet"
    />

    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>

</head>
<body>
    <div id="nav-placeholder"></div>

    <div class="container">
      <div class="page-header">
        <h1>Postet e juaja</h1>
      </div>

      <div class="content-wrapper container center">
        <div class="main-content">
          <form action="" method="POST" style="width: max-content">
          <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
              <article class="item-card" style="margin: 10px 0;">
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

                        <div class="form-radio">
                          <div class="option">
                            <!-- <input type="radio" id="" name="" value=""> -->
                            <!-- <label for="lost">Eshte gjetur</label> -->
                            <input type="hidden" name="update_posts" value="1">

                            <input 
                              type="checkbox" 
                              name="found_posts[]" 
                              value="<?php echo $row['id']; ?>"
                              <?php echo $row['is_found'] ? 'checked disabled' : ''; ?>
                              >
                            <label style="font-size: 16px;">E gjetur</label>
                          </div>
                        </div>
                      </div>
                    </div> 
                  </div>
                </article>
              <?php endwhile; ?>
          <?php else: ?>
            <h1>Nuk ka poste momentalisht.</h1>
          <?php endif; ?>

          <!-- CSS-in e ndryshoj ma von -->
          <input type="submit" name="submit" value="Ruaj ndryshimet" style="
            width: 50%;

            color: var(--color-white);
            background-color: var(--color-primary);

            border: none;
            border-radius: 10px;

            margin-top: 20px;
            margin-left: 20vw;
            padding: 10px;
          ">
        </form>
    </div>
    </div>
    </div>
    <script>
      $(function(){
        $("#nav-placeholder").load("nav.php");
      });
    </script>
</body>
</html>