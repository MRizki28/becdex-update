<?php session_start();
echo ($_POST['captcha'] != $_SESSION['captcha']) ? 0 : 1;