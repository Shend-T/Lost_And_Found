<?php 
include "db.php";

// Duhet siguruar qe user-i eshte i log-uar
if (!(isset($_COOKIE["user_username"]) and isset($_COOKIE["user_id"]))) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['post_id'])) {
  include "user/user_post.php";
  exit;
} else {
  include "user/user_all_posts.php";
  exit;
}
?>