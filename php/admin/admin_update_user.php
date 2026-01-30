<?php 
$user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;
if ($user_id <= 0) {
  header("Location: admin.php");
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
        <link
        href="https://fonts.googleapis.com/css?family=Ubuntu:regular,bold&subset=Latin"
        rel="stylesheet"
        />
    </head>
    <body>
        
    </body>
</html>