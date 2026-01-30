<?php 
if (!isset($_SESSION['admin_authenticated']) && $_SESSION['admin_authenticated'] !== true) {
    header('Location: admin_content.php');
    exit;
}

if (isset($_POST["sign_out"])) {
    $_SESSION['admin_authenticated'] = false;
    $_SESSION['admin_user_id'] = null;
    
    header("Location: index.php");
    exit();
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
    <div class="container">
        <h1>UBT Lost And Found - Paneli Admin</h1>
        <p>Pershendetje, Administrator! Menaxho user-et edhe postet.</p>
        <form action="" method="POST">
            <button name="sign_out" class="logout-button">Log Out</button>
        </form>

        <div class="section">
            <h2>Menaxhimi User-eve</h2>
            <?php 
            $sql_users = "SELECT ID, Username, Password FROM users WHERE is_admin = 0 ORDER BY ID DESC";
            $result_users = $conn->query($sql_users);
            $users_count = $result_users ? $result_users->num_rows : 0;
            ?>

            <?php if ($users_count > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php while ($user = $result_users->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $user["ID"] ?></td>
                                <td><?php echo $user["Username"] ?></td>
                                <td><?php echo substr($user['Password'], 0, 20) . '...'; ?></td>
                                <td><button>UPDATE</button><button>DELETE</button></td>
                            </tr>
                        <?php endwhile ?>
                    </tbody>
                </table>
            <?php endif ?>
        </div>
        <div class="section">
            <h2>Menaxhimi i Posteve</h2>
            <?php 
            $sql_posts = "SELECT * FROM posts ORDER BY ID DESC";
            $result_posts = $conn->query($sql_posts);
            $posts_count = $result_posts ? $result_posts->num_rows : 0;
            ?>

            <?php if ($posts_count > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Number</th>
                            <th>Description</th>
                            <th>Type</th>
                            <th>Location</th>
                            <th>Date</th>
                            <th>User ID</th>
                            <th>Is Found</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php while ($post = $result_posts->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $post["id"] ?></td>
                                <td><?php echo $post["title"] ?></td>
                                <td>
                                    <?php 
                                        $imgInfo = getimagesizefromstring($post['image']);
                                        $mime = $imgInfo['mime'];
                                        
                                        $imageData = base64_encode($post['image']);
                                        $imageSrc = "data:$mime;base64,$imageData";
                                    ?>
                                    <img src="<?php echo $imageSrc; ?>" width="24px" height="24px">
                                </td>
                                <td><?php echo $post['number'] ?></td>
                                <td><?php echo substr($post['description'], 0, 10) . '...'; ?></td>
                                <td><?php echo $post['type'] ?></td>
                                <td><?php echo $post['location'] ?></td>
                                <td><?php echo $post['date'] ?></td>
                                <td><?php echo $post['user_id'] ?></td>
                                <td><?php echo $post['is_found'] ?></td>

                                <td><button>UPDATE</button><button>DELETE</button></td>
                            </tr>
                        <?php endwhile ?>
                    </tbody>
                </table>
            <?php endif ?>
        </div>
    </div>
</body>
</html>