<?php 
include 'db.php';

if (isset($_COOKIE["user_username"]) and isset($_COOKIE["user_id"])) {
    echo "The value of 'user_username' is: " . $_COOKIE["user_username"];
    echo "The value of 'user_id' is: " . $_COOKIE["user_id"];
} else {
    header("Location: php/login.php");
    exit();
}

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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>UBT - Lost And Found</title>

    <!-- === Title Icon === -->
    <link rel="icon" href="media/favicon.ico" type="image/x-icon" />

    <!-- === CSS Links === -->
    <link rel="stylesheet" href="./css/index.css" />
    <link
      href="https://fonts.googleapis.com/css?family=Ubuntu:regular,bold&subset=Latin"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="./css/home.css">
  </head>
  <body>
    <nav>
      <a href="home.html"
        ><img src="../img/download.png" alt="logo" id="logo"
      /></a>

      <div class="nav-icons">
        <a href="home.html" class="nav-icon active"
          ><img src="../img/home.png" alt="home"
        /></a>
        <a href="found.html" class="nav-icon"
          ><img src="../img/found.png" alt="found"
        /></a>
        <a href="lost.html" class="nav-icon"
          ><img src="../img/lost.png" alt="lost"
        /></a>
        <a href="user.html" class="nav-icon"
          ><img src="../img/user.png" alt="user"
        /></a>
      </div>
    </nav>

    <h1>UBT - Lost and Found</h1>

    <p>
      Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vitae amet
      voluptate ipsam eaque iusto iste dicta repellendus adipisci aliquid
      tempore? Quisquam libero ipsum beatae labore accusantium, nisi at maxime
      possimus eligendi, totam reiciendis molestias! Voluptatum sapiente
      nesciunt ratione, unde facere atque. Totam dolor quibusdam magni odit
      officia, atque tempora ex.
    </p>

    <hr />

    <a style="font-size: 100px" href="php/index.php">Index</a>

    <!-- === JS Links === -->
    <script type="module" src="./js/index.js"></script>
  </body>
</html>
