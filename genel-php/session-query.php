<?php
session_start();
  if (!isset($_SESSION['user_id'])) {
    header("location: ../Login/LearnifyLogin.html");
}
$userID = $_SESSION["user_id"];
?>