<?php
    session_start();
    if (!isset($_SESSION['user']) && !isset($_SESSION['admin']) && !isset($_SESSION['reset'])){
        header("Location: ../../login.php");
        exit();
    }else{
        session_destroy();
        header("Location: ../../index.php");
    }