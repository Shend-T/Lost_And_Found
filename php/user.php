<?php
include "db.php";

if (!(isset($_COOKIE["user_username"]) and isset($_COOKIE["user_id"]))) {
    header("Location: login.php");
    exit();
}

$name = $_COOKIE["user_username"];
$user_id = (int) $_COOKIE["user_id"]; //Sepse ne cookie, user_id eshte string
// $name = "USER";

if (isset($_POST['submit'])) {
    $title     = $_POST["title"];
    $phone_num = $_POST["phone_number"];
    $desc      = $_POST["description"];
    $type      = ($_POST['item'] === "lost") ? 1 : 0;

    $tmpName = $_FILES['image']['tmp_name'];
    $fileName = $_FILES['image']['name'];
    $fileType = $_FILES['image']['type'];
    $date = date('Y-m-d');

    // Read the binary data from the temporary file
    $imageData = file_get_contents($tmpName);

    $sql = "INSERT INTO posts (title, image, number, description, type, user_id, date) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    $stmt->bind_param(
        "sbisiis", 
        $title, 
        $imageData, 
        $phone_num, 
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
        <div class="paper glass flex">
            <div class="form-header flex center-h">
                <h1>Pershendetje <?php echo $name; ?> keni n'donje gje per te raportuar?</h1>
            </div>
            <hr>
    <!-- <form action="" method="POST" enctype="multipart/form-data"> -->
    <div class="form-container flex center">
        <!-- <h1>Pershendetje <?php echo $name; ?> keni n'donje gje per te raportuar?</h1> -->
        
        <form class="form flex center-v" action="" method="POST" enctype="multipart/form-data">
            <label for="title">Title: </label>
            <input type="text" name="title" id="title" required>

            <input type="file" name="image" id="img" accept="image/*" required>

            <label for="phone_number">Numri kontaktit: </label>
            <input type="number" name="phone_number" id="phone_number" required>

            <label for="description">Detaje tjera: </label>
            <textarea name="description" rows="5" cols="50"></textarea>

            <div class="form-radio">
                <div class="option">
                    <input type="radio" id="lost" name="item" value="lost" required>
                    <label for="lost">Found a lost item</label>
                </div>
                <div class="option">
                    <input type="radio" id="found" name="item" value="found">
                    <label for="found">Reporting a lost item</label>
                </div>
            </div>

            <input type="submit" name="submit" value="Report A Lost Item">
            <!-- <button type="submit">Report a Lost Item</button> -->
        </form>
        <a href="index.php">Return</a>
    </div>
    </div>
    </div>

    <!-- Ensure image has max size of 256x256 pixels -->
    <script>   
    document.getElementById("img").addEventListener("change", function () {
        const file = this.files[0];
        if (!file) return;

        const img = new Image();
        img.onload = function () {
            if (img.width > 256 || img.height > 256) {
                alert("Image must be max 256x256 pixels.");
                document.getElementById("imge").value = ""; // clear input
            }
        };

        const reader = new FileReader();
        reader.onload = e => img.src = e.target.result;
        reader.readAsDataURL(file);
    });
    </script>

    <!-- Ensure number input is only numbers -->
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