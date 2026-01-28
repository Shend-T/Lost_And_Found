<?php 
if (isset($_POST['auth'])) {
    $id       = (int) $_POST["id"];
    $password = $_POST["password"];
    
    if (empty($id) || empty($password)) {
        die("Invalid input");
    }

    $sql  = "SELECT * FROM users WHERE ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        $is_admin = $user['is_admin'];
        $correct_password = password_verify($password, $user["Password"]);

        if($is_admin && $correct_password) {
            $_SESSION['admin_authenticated'] = true;
            $_SESSION['admin_user_id'] = $user['ID'];

            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        } else {
            echo "<script>
                alert('Mos u mundoni me e imitu admin-in!');
            </script>";
            header('Location: index.php');
        }
    } else {
        echo "<script>alert('Mos u mundoni me e imitu admin-in!');</script>";
        header('Location: index.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - UBT Lost And Found</title>
</head>
<body>
    <a href="index.php">Home</a>
    <form action="" method="POST">
        <label for="id">Admin ID: </label>
        <input type="number" name="id" id="id" >

        <label for="password">Password:</label>
        <input type="password" name="password">

        <button type="submit" name="auth">Authenticate</button>
    </form>    
</body>
</html>