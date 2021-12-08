<?php
    require_once '../assets/src/buildPage.php';
    require_once '../assets/src/filmListingsFunctions.php';
    require_once '../assets/src/getNavigationLinks.php';
    require_once '../assets/src/sessionFunctions.php';
    ini_set("session.save_path", "C:/xampp/htdocs/swd-final-assignment/assets/session-data");
    session_start(); 
    $s = getSessionData();
    print_r($s);
?> 