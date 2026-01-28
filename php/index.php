<?php
include 'db.php';

// if (!(isset($_COOKIE["user_username"]) and isset($_COOKIE["user_id"]))) {
//     header("Location: login.php");
//     exit();
// }

if (isset($_POST["sign_out"])) {
  setcookie("user_username", "", time() - 3600); 
  setcookie("user_id", "", time() - 3600); 
  header("Refresh: 0");
  exit();
}
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
        <form action="" method="POST">
            <button type="submit" name="sign_out">Sign Out</button>
        </form>    

        <!-- Hero Section -->
        <section class="hero">
            <div class="hero-content">
                <h1>Ke humbur diçka? Ke gjetur diçka?</h1>
                <p class="hero-subtitle">Ne ndihmojmë në ribashkimin e sendeve të humbura me pronarët e tyre. Raportoni sende të humbura ose të gjetura dhe shfletoni listat për të gjetur atë që po kërkoni.</p>
                <div class="hero-buttons">
                    <a href="lost.php" class="btn btn-primary">Gjej Diqka Të Humbur</a>
                    <a href="user.php" class="btn btn-secondary">Raporto Diqka Të Humbur/Gjetur.</a>
                </div>
            </div>
            <div class="hero-image">
                <img src="../media/human.jpg" alt="Lost and Found">
            </div>
        </section>

        <!-- Stats Section -->
        <section class="stats">
            <div class="stat-card">
                <div class="stat-number">1,245</div> <!-- Keto numra jane vetem per estetike -->
                <div class="stat-label">Gjera Te Raportuara</div> <!-- Per bese nuk po di menyre me te mire me e then shqip -->
            </div>
            <div class="stat-card">
                <div class="stat-number">856</div>
                <div class="stat-label">Gjëra të gjetura</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">389</div>
                <div class="stat-label">Poste Aktive</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">2,150+</div>
                <div class="stat-label">Përdurues</div>
            </div>
        </section>

        <!-- How It Works Section -->
        <section class="how-it-works">
            <h2>Si Punon</h2>
            <div class="steps">
                <div class="step">
                    <div class="step-number">1</div>
                    <h3>Raporto</h3>
                    <p>Raportoni një send të humbur ose të gjetur me detaje dhe foto. Sa më shumë informacion të jepni, aq më e lehtë është të përputhen sendet.</p>
                </div>
                <div class="step">
                    <div class="step-number">2</div>
                    <h3>Shfleto</h3>
                    <p>Kërkoni nëpër lista ose shfletoni sipas kategorisë. Filtroni sipas vendndodhjes, datës ose llojit të artikullit për të gjetur atë që po kërkoni.</p>
                </div>
                <div class="step">
                    <div class="step-number">3</div>
                    <h3>Kontakto</h3>
                    <p>Kontaktoni pronarin ose gjetësin përmes sistemit tonë të mesazheve të sigurta. Verifikoni pronësinë dhe caktoni një vend të sigurt takimi.</p>
                </div>
                <div class="step">
                    <div class="step-number">4</div>
                    <h3>Ribashkohu</h3> <!-- Nuk po di term më adekuat -->
                    <p>Ribashkoni me sukses artikujt me pronarët e tyre! Shënoni artikujt si të kthyer dhe ndani historinë tuaj të suksesit me komunitetin tonë.</p>
                </div>
            </div>
        </section>

        <!-- Recent Listings Section -->
        <section class="recent-listings">
            <h2>Postet Më Të Fundit</h2>
            <div class="listings-grid">
                <?php 
                    $sql = "SELECT * FROM posts
                            WHERE is_found = 0
                            ORDER BY date DESC
                            LIMIT 5"; // e limitojme qe te jene vetem 5 postet e fundit
                    $result = $conn->query($sql);
                ?>

                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <div class="listing-card <?php echo ($row['type'] == 1) ? 'lost' : 'found'; ?>">
                            <div class="listing-badge <?php echo ($row['type'] == 1) ? 'lost' : 'found'; ?>-badge">
                                <?php echo ($row['type'] == 1) ? 'E HUMBUR' : 'E GJETUR'; ?>
                            </div>
                    
                            <?php
                                $imgInfo = getimagesizefromstring($row['image']);
                                $mime = $imgInfo['mime'];

                                $imageData = base64_encode($row['image']);
                                $imageSrc = "data:$mime;base64,$imageData";
                            ?>
                            <img src="<?php echo $imageSrc; ?>" alt="<?php echo ($row['type'] == 1) ? 'Lost' : 'Found'; ?> Item" class="listing-image">
                            <div class="listing-info">
                                <h3><?php echo $row['title']; ?></h3>
                                <p class="listing-location">📍 <?php echo $row['location']; ?></p>
                                <p class="listing-date"><?php echo $row['date']; ?></p>
                                <p class="listing-description"><?php echo $row['description']; ?></p>
                            </div>
                            <a href="details.php?id=<?= $row['id'] ?>" class="read-more">Shiko Detajet</a>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
            <div class="view-all">
                <a href="lost.php" class="btn btn-outline">SHIKO TE GJITHA</a>
            </div>
        </section>

        <!-- Features Section -->
        <section class="features">
            <h2>Pse Na Zgjidhni Ne?</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">🔍</div>
                    <h3>Kërkim i Lehtë</h3>
                    <p>Filtrat e lehtë të kërkimit ju ndihmojnë të gjeni artikuj shpejt sipas vendndodhjes, kategorisë dhe datës.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📸</div>
                    <h3>Verifikimi Me Foto</h3>
                    <p>Ngarko foto të artikujve për identifikim më të mirë dhe verifikim të pronësisë.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🌍</div>
                    <h3>Fokusi Lokal</h3>
                    <p>Lidhu me njerëz në zonën tënde. Perfekt për objektet e humbura dhe të gjetura në kampus dhe komunitet.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">✅</div>
                    <h3>Përdorues Të Verifikuar</h3>
                    <p>Komunitet i besuar me llogari të verifikuara për të siguruar transaksione të sigurta dhe legjitime.</p>
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
            Të gjitha të drejtat e rezervuara
          </p>
        </div>

        <!-- Contact -->
        <div class="footer-section footer-contact">
          <h1>Kontakti</h1>
          <p><span>Tel:</span> +383 XX XXX XXX</p>
          <p><span>Email:</span> contact@ubt-uni.net</p>
        </div>
      </div>
    </footer>

    <script>
      $(function(){
        $("#nav-placeholder").load("nav.php");
      });
    </script>
</body>
