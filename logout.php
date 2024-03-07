<?php
session_start();
session_destroy();
echo "Loading...";
header("Refresh: 2; url=index.php");
