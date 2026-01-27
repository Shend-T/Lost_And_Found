<?php
include "db.php";

if (isset($_COOKIE["user_username"]) and isset($_COOKIE["user_id"])) {
    // Nese user-i esht i log-uar
    header("Location: index.php");
    exit();
}

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash - ojme passwordin, pasi qe password-i eshte i hashuar ne db
    // Per me shume, ktu jemi referencuar - https://www.php.net/manual/en/function.password-hash.php

    $sql = "SELECT * FROM users WHERE ID = ?"; // Lypim user-in me ID e shkruar
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        $correct_password = password_verify($password, $user["Password"]); // Verifikojme passwordin( dyjat duhen te jene te hash-uar)
        // Per me shume - https://www.php.net/manual/en/function.password-verify.php

        if ($correct_password) {
            // Nese gjithqka eshte ne rregull, i ruajm si 'cookies' keto vlera.
            setcookie("user_username", $user['Username'], time() + 3600 * 24 * 10);
            setcookie("user_id", $user['ID'], time() + 3600 * 24 * 10);
            
            $stmt->close();
            $conn->close();

            header("Location: index.php");
            exit();
        } else {
            $message = "Incorrect Password!";
        
            echo "<script>alert('$message');</script>";
        }
    } else {
        $message = "User with your ID doesn't exist!";
        
        echo "<script>alert('$message');</script>";
    }
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
    <link rel="stylesheet" href="../css/auth.css">
    <link
      href="https://fonts.googleapis.com/css?family=Ubuntu:regular,bold&subset=Latin"
      rel="stylesheet"
    />
</head>
<body>
    <div class="container flex center">
        <div class="paper flex">
            <div class="form-header flex center-h">
                <h1>Welcome back!</h1>
                <p>Please enter you're login info...</p>
            </div>
            <hr>

            <div class="form-container flex center">
                <form class="form flex center-v" action="" method="POST">
                    <label for="id">Student ID: </label>
                    <input type="number" name="id" id="id" >

                    <label for="password">Password:</label>
                    <input type="password" name="password">

                    <input type="submit" name="submit" value="Log In">
                </form>

                <br />
                <p>Don't Have An Account? <a href="signup.php">Sign Up</a></p>
            </div>
        </div>
    </div>

    <script>
    const numberInput = document.getElementById('id');

    numberInput.addEventListener('keypress', function(event) {
        if (event.key < '0' || event.key > '9') {
        event.preventDefault();
        }
    });
    </script>
</body>
</html>