<?php 
$user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;
if ($user_id <= 0) {
  header("Location: admin.php");
}

$sql = "SELECT * FROM users 
        WHERE ID = " . intval($user_id);
$result = $conn->query($sql);

if (!$result || $result->num_rows === 0) {
  echo "<script>alert('Nuk ekziston user-i')</script>";
  header("Location: admin.php");
  exit;
}

$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_post'])) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($password !== $user['Password']) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    } else {
        $hashed_password = $user['Password'];
    }

    $update_sql = "UPDATE users SET 
                   Student_ID = ?, 
                   Username = ?, 
                   Password = ?";
    $params = [$id, $username, $hashed_password];
    $param_types = "iss";

    $update_sql .= " WHERE ID = ?";
    $params[] = $user_id;
    $param_types .= "i";

    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param($param_types, ...$params);
    if ($stmt->execute()) {
        echo "<script>alert('User-i u update-ua me sukses')</script>";
        $stmt->close();

        header("Location: ../admin.php");
        exit;
    } else {
        echo "<script>alert('Error gjate update-imit')</script>";
        $stmt->close();
        header("Location: " . $_SERVER['PHP_SELF']);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin - UBT Lost And Found</title>

        <!-- === Title Icon === -->
        <link rel="icon" href="../media/favicon.ico" type="image/x-icon" />

        <!-- === CSS Links === -->
        <link rel="stylesheet" href="../../css/index.css" />
        <link rel="stylesheet" href="../../css/user.css" />

        <link
            href="https://fonts.googleapis.com/css?family=Ubuntu:regular,bold&subset=Latin"
            rel="stylesheet"
        />
    </head>
    <body>
        <div class="container flex center">
        <div class="paper glass flex center paper-post">
            <div class="form-header flex center-h">
                <h1>Ndrysho User-in</h1>
            </div>
            <hr>

            <div class="form-container flex center" style="height: max-content;">
                <form 
                    class="form flex center-v" 
                    action="" 
                    method="POST" 
                    >
                        <label for="id">Student ID: </label>
                        <input type="number" name="id" id="idInput" value="<?php echo $user['ID'] ?>">

                        <label for="username">Username: </label>
                        <input type="text" name="username" value="<?php echo $user['Username'] ?>">

                        <label for="password">Password:</label>
                        <input type="text" name="password" value="<?php echo $user['Password'] ?>">
                        <!-- Ktu e lejme text pasi qe esht faqe e admin-it -->

                        <input 
                            type="submit" 
                            name="update_post" 
                            value="Edito!" 
                            class="post_button update"
                            style="padding: 10px 20px; background: #4CAF50; color: white; border: none; border-radius: 4px; cursor: pointer;"
                            >
                </form>
            </div>
            <div class="flex center" style="width: 100%;">
                <a href="../admin.php" class="show_posts">Kthehu</a>
            </div>
        </div>
        </div>
    </body>
</html>