<?php

    require_once '../config/config.php';
    session_destroy();
    header("refresh: 2; url=../auth/login.php");

?>