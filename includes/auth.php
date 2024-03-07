<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('url: /index.php');
    exit;
}
