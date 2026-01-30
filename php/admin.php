<?php
include 'db.php'; 
session_start();

if (isset($_SESSION['admin_authenticated']) && $_SESSION['admin_authenticated'] === true) {
    include 'admin/admin_content.php';
    exit;
}
include 'admin/admin_auth.php';
exit;
?>