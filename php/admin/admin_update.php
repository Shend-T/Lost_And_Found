<?php 
include "../db.php";

if (isset($_GET['post_id'])) {
  include "admin_update_post.php";
  exit;
}
if (isset($_GET['user_id'])) {
  include "admin_update_user.php";
  exit;
}
else {
  header('Location: ../admin.php');
  exit;
}
?>