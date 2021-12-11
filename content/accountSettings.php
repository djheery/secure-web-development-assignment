<?php 
    require_once '../assets/src/buildPage.php';
    require_once '../assets/src/sessionFunctions.php';

    generateSession();
    $sessionData = getSessionData();
    // Add Check For login
?>