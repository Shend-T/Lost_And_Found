<?php
include "db.php";

if (!(isset($_COOKIE["user_username"]) and isset($_COOKIE["user_id"]))) {
    header("Location: login.php");
    exit();
}

$name = $_COOKIE["user_username"];
$user_id = (int) $_COOKIE["user_id"]; //Sepse ne cookie, user_id eshte string

if (isset($_POST['submit'])) {
    $title     = $_POST["title"];
    $phone_num = $_POST["phone_number"];
    $location = $_POST["location"];
    $desc      = $_POST["description"];
    $type      = ($_POST['item'] === "lost") ? 1 : 0;

    $tmpName = $_FILES['image']['tmp_name'];
    $fileName = $_FILES['image']['name'];
    $fileType = $_FILES['image']['type'];
    $date = date('Y-m-d');

    // Lexo 'data'-n binare nga file-i
    $imageData = file_get_contents($tmpName);

    $sql = "INSERT INTO posts 
           (title, image, number, location, description, type, user_id, date) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    $stmt->bind_param(
        "sbissiis", 
        $title, 
        $imageData, 
        $phone_num, 
        $location,
        $desc, 
        $type,
        $user_id,
        $date);
    $stmt->send_long_data(1, $imageData);
    // $stmt->send_long_data(1, $imageBlob);

    $stmt->execute();
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
    <link rel="stylesheet" href="../css/user.css">
    <link
      href="https://fonts.googleapis.com/css?family=Ubuntu:regular,bold&subset=Latin"
      rel="stylesheet"
    />

    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
</head>
<body>
    <div id="nav-placeholder"></div>
 
    <div class="container flex center">
        <div class="paper glass flex center">
            <!-- <a href="user.php" class="back-button" id="backButton">Kthehu</a> -->
            <div class="form-header flex center-h">
                <h1>Pershendetje <?php echo $name; ?> keni ndonje gje per te raportuar?</h1>
            </div>
            <hr>

            <div class="form-container flex center">
                <form class="form flex center-v" action="" method="POST" enctype="multipart/form-data">
                    <label for="title">Titulli: </label>
                    <input type="text" name="title" id="title" required>

                    <label for="img">Foto:</label>
                    <input type="file" name="image" id="img" accept="image/*" required>

                    <label for="phone_number">Numri kontaktit: </label>
                    <input type="number" name="phone_number" id="phone_number" required>

                    <label for="location">Vendi ku e keni gjetur: </label>
                    <input type="text" name="location" id="location" required>

                    <label for="description">Detaje tjera: </label>
                    <textarea name="description" rows="5" cols="50"></textarea>

                    <div class="form-radio">
                        <div class="option">
                            <input type="radio" id="lost" name="item" value="lost" required>
                            <label for="lost">Kerkoj Diqka Te Humbur</label>
                        </div>
                        <div class="option">
                            <input type="radio" id="found" name="item" value="found">
                            <label for="found">Raportoj Diqka Te Humbur</label>
                        </div>
                    </div>

                    <input type="submit" name="submit" value="Krijo Postin">
                </form>
            </div>
            <div class="flex center" style="width: 100%;">
                <a href="user_posts.php" class="show_posts">Kthehu te postimet e tua</a>
            </div>
        </div>
    </div>

    <!-- Ensure image has max size of 256x256 pixels -->
    <script>   
        // Kod i inspiruar nga: https://stackoverflow.com/questions/8903854/check-image-width-and-height-before-upload-with-javascript
        document.getElementById("img").addEventListener("change", function () {
            const file = this.files[0];
            if (!file) return;

            const img = new Image();
            img.onload = function () {
                if (img.width > 256 || img.height > 256) {
                    alert("Imazhi mund te jete maksimum 256x256 piksella.");
                    document.getElementById("img").value = ""; // clear input
                }
            };

            const reader = new FileReader();
            reader.onload = e => img.src = e.target.result;
            reader.readAsDataURL(file);
        });
    </script>

    <!-- Sigurohemi qe ne input-in e numrit, te jene vetem numra te shkruar -->
    <script>
    const numberInput = document.getElementById('phone_number');

    numberInput.addEventListener('keypress', function(event) {
        if (event.key < '0' || event.key > '9') {
        event.preventDefault();
        }
    });
    </script>

    <script>
      $(function(){
        $("#nav-placeholder").load("nav.php");
      });
    </script>
</body>
</html>