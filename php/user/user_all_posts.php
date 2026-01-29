<?php 
$user_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($user_id != $_COOKIE["user_id"]) {
  // Sigurojme qe id-ja ne url dhe id-ja e user-it jane te njejta, perndryshe nje user mund t'i sheh postet e nje user-i tjeter
  header("Location: index.php");
}

$sql = "SELECT * FROM posts
        WHERE user_id = " . intval($user_id);
$result = $conn->query($sql);
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
    <!-- Po i riperdori kto css file-a pasi qe kodi esht thuajse i njejt -->
    <link rel="stylesheet" href="../css/user.css">
    <link rel="stylesheet" href="../css/found.css" />
    <link
      href="https://fonts.googleapis.com/css?family=Ubuntu:regular,bold&subset=Latin"
      rel="stylesheet"
    />

    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>

    <style>
        /* Po kallxohem i sinqert, pritova me e shtu edhe nje css file : ) ( besoj qe nuk qet problem :) ) */
        .edit-button {
            font-size: 14px;
            padding: 10px;

            color: var(--secondary-text-color);
            background-color: #244082;

            border-radius: 10px;
        }
        .edit-button:hover {
            filter: opacity(0.9);
        }
    </style>
</head>
<body>
    <div id="nav-placeholder"></div>

    <div class="container">
        <div class="page-header">
            <h1>Postet e Juaja</h1>
        </div>

        <div class="content-wrapper container">
            <div class="main-content">
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <article class="item-card" style="margin: 10px 0;">
                            <div class="date-section"></div>
                            
                            <div class="item-content">
                                <?php
                                    $imgInfo = getimagesizefromstring($row['image']);
                                    $mime = $imgInfo['mime'];
                                    
                                    $imageData = base64_encode($row['image']);
                                    $imageSrc = "data:$mime;base64,$imageData";
                                ?>
                                <img
                                    src="<?php echo $imageSrc; ?>"
                                    alt="<?php echo $row['title']; ?>"
                                    class="item-image"
                                />
                                <div class="item-details">
                                    <div>
                                        <p class="item-title"><?php echo $row['title'] ?></p>
                                        <p class="item-description"><?php echo $row['description'] ?></p>
                                        <?php
                                            $query_params = $_GET; // Kjo i merr te gjithe parametrat ne URL
                                            $query_params['post_id'] = $row['id']; // Dhe shton post_id
                                        ?>
                                        <a href="?<?php echo http_build_query($query_params); ?>" class="edit-button">Edito Postin</a>
                                        <!--https://www.php.net/manual/en/function.http-build-query.php -->
                                    </div>
                                </div>
                            </div>
                        </article>
                    <?php endwhile ?>
                <?php else: ?>
                    <h1>Nuk ka poste momentalisht.</h1>
                <?php endif ?>
            </div>
        </div>
    </div>

    <script>
      $(function(){
        $("#nav-placeholder").load("nav.php");
      });
    </script>
</body>