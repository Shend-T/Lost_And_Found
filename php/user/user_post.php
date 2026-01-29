<?php 
$user_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($user_id != $_COOKIE["user_id"]) {
  // Sigurojme qe id-ja ne url dhe id-ja e user-it jane te njejta, perndryshe nje user mund t'i sheh postet e nje user-i tjeter
  header("Location: index.php");
}

$post_id = isset($_GET['post_id']) ? intval($_GET['post_id']) : 0;
if ($post_id <= 0) {
  header("Location: index.php");
}

$sql = "SELECT * FROM posts 
        WHERE id = " . intval($post_id) 
        . " AND user_id = " . intval($user_id);
$result = $conn->query($sql);

if (!$result || $result->num_rows === 0) {
  echo "<script>alert('Nuk ekziston posti')</script>";
  header("Location: index.php");
  exit;
}

$post = $result->fetch_assoc();

$imgInfo = getimagesizefromstring($post['image']);
$mime = $imgInfo['mime'];
$imageData = base64_encode($post['image']);
$imageSrc = "data:$mime;base64,$imageData"; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $phone_number = $_POST['phone_number'];
    $is_found = $_POST['is_found'];
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

        $update_sql .= " WHERE id = ? AND user_id = ?";
        $params[] = $post_id;
        $params[] = $user_id;
        $param_types .= "ii";

        $stmt = $conn->prepare($update_sql);
        $stmt->bind_param($param_types, ...$params);
        $stmt->send_long_data(6, $imageData);
        $stmt->execute();
    }
    else {
        $update_sql .= " WHERE id = ? AND user_id = ?";
        $params[] = $post_id;
        $params[] = $user_id;
        $param_types .= "ii";

        $stmt = $conn->prepare($update_sql);
        $stmt->bind_param($param_types, ...$params);
        $stmt->execute();
    }

    header("Location: user.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lost Items - UBT Lost And Found</title>

    <!-- === Title Icon === -->
    <link rel="icon" href="../media/favicon.ico" type="image/x-icon" />

    <!-- === CSS Links === -->
    <link rel="stylesheet" href="../css/index.css" />
    <link rel="stylesheet" href="../css/details.css" />

    <link
      href="https://fonts.googleapis.com/css?family=Ubuntu:regular,bold&subset=Latin"
      rel="stylesheet"
    />

    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
</head>
<body>
    <div id="nav-placeholder"></div>

    <div class="container" style="margin-top: 10vh;">
        <a href="user.php" class="back-button" id="backButton">Kthehu</a>
        <h1>Edito Postin</h1>

        <div class="detail-card">
            <form 
                class="form center" 
                action="" 
                method="POST" 
                enctype="multipart/form-data"
                <!-- style="width: 100%;" -->
                >
            <div class="detail-image-container">
                <img 
                    src="<?php echo $imageSrc; ?>"
                    alt="<?php echo $post['title']; ?>"
                    class="detail-image"
                    id="detailImage"
                    style="width: 100px !important; height: auto; margin-bottom: 20px;"
                     />
                    <label style="padding-top: 20px;" class="detail-contact-label" id="contactLabel" for="image">Ndrysho foton:</label>
                    <div>
                        <input 
                            type="file" 
                            name="image" 
                            id="image" 
                            accept="image/*"
                            onchange="previewImage(event)">
                    </div>
            </div>
            <div class="detail-content">
                <div class="detail-contact">
                    <label class="detail-contact-label" id="contactLabel" for="title">Titulli: </label>
                    <div>
                        <input 
                            type="text" 
                            name="title" 
                            id="title" 
                            required 
                            value="<?php echo $post['title'] ?>">
                    </div>
                </div>

                <div class="detail-contact">
                    <label class="detail-contact-label" id="contactLabel" for="description">Detaje tjera: </label>
                    <div>
                        <textarea name="description" rows="5" cols="50"><?php echo $post['description'] ?>
                        </textarea>
                    </div>
                </div>

                <div class="detail-contact">
                    <label class="detail-contact-label" id="contactLabel" for="location">Vendi ku e keni gjetur: </label>
                    <div>
                    <input 
                        type="text" 
                        name="location" 
                        id="location" 
                        required
                        value="<?php echo $post['location'] ?>"
                        >
                    </div>
                </div>

                <div class="detail-contact">
                    <label class="detail-contact-label" id="contactLabel" for="phone_number">Kontakti: </label>
                    <div>
                        <input 
                            type="number" 
                            name="phone_number" 
                            id="phone_number" 
                            required 
                            value="<?php echo $post['number'] ?>"
                            >
                    </div>
                </div>

                <div class="detail-contact">
                    <input 
                        type="checkbox" 
                        name="is_found" 
                        value="<?php echo $post['is_found']; ?>"
                        <?php echo $post['is_found'] ? 'checked' : ''; ?>
                        >
                    <label style="font-size: 16px;">E gjetur</label>
                </div>

                <div>
                    <button>Edito!</button>
                </div>
            </div>
            </form>
        </div>
    </div>

    <script>
      $(function(){
        $("#nav-placeholder").load("nav.php");
      });
    </script>

    <script>
        function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function(){
          var output = document.getElementById('detailImage');
          output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
      }
    </script>
</body>
</html>