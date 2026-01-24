<?php 
include "db.php";
$sql = "SELECT title, image, number, description, type, user_id FROM posts WHERE id = 1";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();

    $title = $row['title'];
    $number = $row['number'];
    $description = $row['description'];
    $type = $row['type']; // 1 = lost item found, 0 = reporting

    $imgInfo = getimagesizefromstring($row['image']);
    $mime = $imgInfo['mime']; // "image/png", "image/jpeg", "image/webp", etc.

    // Convert blob to base64 image data
    $imageData = base64_encode($row['image']);
    $imageSrc = "data:$mime;base64,$imageData";

    $sql_user = "SELECT Username FROM users WHERE id = " . $row['user_id'];
    $result_user = $conn->query($sql_user);
    
    $user_id = $result_user->fetch_assoc()['Username'];
} else {
    die("Post not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2><?php echo $title; ?></h2>

<img src="<?php echo $imageSrc; ?>" alt="Image" />

<p>Phone number: <?php echo $number; ?></p>

<p>Description: <?php echo $description; ?></p>

<p>Type: <?php echo ($type == 1 ? "Found a lost item" : "Reporting a lost item"); ?></p>

<p>User that made the post: <?php echo $user_id ?></p>

</body>
</html>