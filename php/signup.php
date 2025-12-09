<?php
include 'db.php';

if (isset($_COOKIE["user_username"]) and isset($_COOKIE["user_id"])) {
    header("Location: index.php");
    exit();
}

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if user exists
    $sql = "SELECT * FROM users WHERE ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $message = "User already exists";
        echo "<script>alert('$message')</script>";
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (ID, Username, Password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $id, $username, $hashed_password);
    $stmt->execute();

    setcookie("user_username", $username, time() + 3600 * 24 * 10);
    setcookie("user_id", $id, time() + 3600 * 24 * 10);

    header("Location: index.php");
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
    <link rel="stylesheet" href="../css/auth.css">
    <link
      href="https://fonts.googleapis.com/css?family=Ubuntu:regular,bold&subset=Latin"
      rel="stylesheet"
    />
</head>
<body>
    <div class="container flex center">
        <div class="paper glass flex">
            <div class="form-header flex center-h">
                <h1>Welcome!</h1>
                <p>Please create you're profile...</p>
            </div>
            <hr>

            <div class="form-container flex center">
                <form class="form flex center-v" action="" method="POST">
                    <label for="id">Student ID: </label>
                    <input type="number" name="id" id="idInput" >

                    <label for="username">Username: </label>
                    <input type="text" name="username" >

                    <label for="password">Password:</label>
                    <input type="password" name="password">

                    <input type="submit" name="submit" value="Sign Up">
                </form>

                <br />
                <p>Already Have An Account? <a href="login.php">Log In</a></p>
            </div>
        </div>
    </div>

    
<script>
  const numberInput = document.getElementById('idInput');

  numberInput.addEventListener('keypress', function(event) {
    if (event.key < '0' || event.key > '9') {
      event.preventDefault();
    }
  });
</script>
</body>
</html>