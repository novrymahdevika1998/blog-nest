<?php
session_start();

if (!isset($_SESSION['username'])) {
    // Redirect to login page if the user is not logged in
    header('url: /login.php');
    exit;
}
