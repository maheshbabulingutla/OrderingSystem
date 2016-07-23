<?php
include_once "login_check.php";
session_destroy(); 

echo '<script>window.location="index.php"</script>';
?>