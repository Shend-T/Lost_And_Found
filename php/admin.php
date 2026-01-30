<?php
include 'db.php'; 
session_start(); // https://www.php.net/manual/en/function.session-start.php

if (isset($_SESSION['admin_authenticated']) && $_SESSION['admin_authenticated'] === true) {
    include 'admin/admin_content.php';
    exit;
} else {
    include 'admin/admin_auth.php';
    exit;
}
?>