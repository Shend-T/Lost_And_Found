<?php 
include "db.php";

// Duhet siguruar qe user-i eshte i log-uar
if (!(isset($_COOKIE["user_username"]) and isset($_COOKIE["user_id"]))) {
    header("Location: login.php");
    exit();
}

$user_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($user_id != $_COOKIE["user_id"]) {
  // Sigurojme qe id-ja ne url dhe id-ja e user-it jane te njejta, perndryshe nje user mund t'i sheh postet e nje user-i tjeter
  header("Location: index.php");
}

if (isset($_GET['post_id'])) {
  include "user/user_post.php";
  exit;
} else {
  include "user/user_all_posts.php";
  exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_posts'])) {
  if (isset($_POST['found_posts'])) {
    foreach ($_POST['found_posts'] as $post_id) {
      $post_id = intval($post_id);

      $sql = "UPDATE posts SET is_found = 1 WHERE id = $post_id";
      $conn->query($sql);
    }
  }
}
?>
