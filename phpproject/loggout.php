<?php
    session_start();
    unset($_SESSION["reg_id"]);
    unset($_SESSION["username"]);
    session_destroy();
    header("Location:login.php");
?>