<?php
$post_id = isset($_GET['post_id']) ? intval($_GET['post_id']) : 0;
if ($post_id <= 0) {
  header("Location: admin.php");
}

$sql = "SELECT * FROM posts 
        WHERE id = " . intval($post_id);
$result = $conn->query($sql);

if (!$result || $result->num_rows === 0) {
  echo "<script>alert('Nuk ekziston posti')</script>";
  header("Location: admin.php");
  exit;
}

$post = $result->fetch_assoc();

$imgInfo = getimagesizefromstring($post['image']);
$mime = $imgInfo['mime'];
$imageData = base64_encode($post['image']);
$imageSrc = "data:$mime;base64,$imageData";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_post'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $phone_number = $_POST['phone_number'];
    // $is_found = $_POST['is_found'];
    $is_found = isset($_POST['is_found']) ? 1 : 0;
    $new_date = date('Y-m-d');

    $update_sql = "UPDATE posts SET 
                   title = ?, 
                   description = ?, 
                   location = ?, 
                   number = ?, 
                   is_found = ?, 
                   date = ?";
    $params = [$title, $description, $location, $phone_number, $is_found, $new_date];
    $param_types = "sssiss";

    $tmpName = $_FILES['image']['tmp_name'];
    $fileName = $_FILES['image']['name'];
    $fileType = $_FILES['image']['type'];

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageData = file_get_contents($tmpName);
        $update_sql .= ", image = ?";
        $params[] = $imageData;
        $param_types .= "b";

        $update_sql .= " WHERE id = ?";
        $params[] = $post_id;
        $param_types .= "i";

        $stmt = $conn->prepare($update_sql);
        $stmt->bind_param($param_types, ...$params);
        $stmt->send_long_data(6, $imageData);
        $stmt->execute();
    }
    else {
        $update_sql .= " WHERE id = ?";
        $params[] = $post_id;
        $param_types .= "i";

        $stmt = $conn->prepare($update_sql);
        $stmt->bind_param($param_types, ...$params);
        $stmt->execute();
    }

    header("Location: ../admin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - UBT Lost And Found</title>

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
                <h1>Ndrysho Postin</h1>
            </div>
            <hr>

            <div class="form-container flex center" style="height: max-content;">
                <form 
                    class="form flex center-v" 
                    action="" 
                    method="POST" 
                    enctype="multipart/form-data"
                    
                    >
                    <img 
                        src="<?php echo $imageSrc; ?>"
                        alt="<?php echo $post['title']; ?>"
                        class="detail-image"
                        id="detailImage"
                        style="width: 100px !important; height: auto; margin-bottom: 20px;"
                        />
                    <label class="detail-contact-label" id="contactLabel" style="margin-right: 10px;" for="image">Ndrysho foton:</label>
                    <input 
                        type="file" 
                        name="image" 
                        id="image" 
                        accept="image/*"
                        onchange="previewImage(event)">

                    <label for="title">Titulli: </label>
                    <input 
                        type="text" 
                        name="title" 
                        id="title" 
                        required 
                        value="<?php echo $post['title'] ?>">

                    <label for="description">Detaje tjera: </label>
                    <textarea name="description" rows="5" cols="50"><?php echo $post['description'] ?></textarea>

                    <label for="location">Vendi ku e keni gjetur: </label>
                    <input 
                        type="text" 
                        name="location" 
                        id="location" 
                        required
                        value="<?php echo $post['location'] ?>"
                        >

                    <label for="phone_number">Numri kontaktit: </label>
                    <input 
                        type="number" 
                        name="phone_number" 
                        id="phone_number" 
                        required 
                        value="<?php echo $post['number'] ?>"
                        >

                    <div class="form-radio">
                    <div class="option">
                    <input 
                            type="checkbox" 
                            name="is_found" 
                            id="is_found"
                            value="1"
                            <?php echo $post['is_found'] ? 'checked' : ''; ?>
                            >    
                    <label for="is_found">E gjetur</label>
                        </div>
                    </div>

                    <input 
                        type="submit" 
                        name="update_post" 
                        value="Edito!" 
                        class="post_button update"
                        style="padding: 10px 20px; background: #4CAF50; color: white; border: none; border-radius: 4px; cursor: pointer;"
                    >
            </form>
        </div>
        </div>
    </div>
</body>
</html>