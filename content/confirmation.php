<?php
    require_once '../assets/src/buildPage.php';
    require_once '../assets/src/filmListingsFunctions.php';
    require_once '../assets/src/getNavigationLinks.php';
    require_once '../assets/src/confirmationHandlers.php';
    require_once '../assets/src/sessionFunctions.php';

    generateSession();
    $sessionData = getSessionData();
    // Add check for login;
    $refferer = isset($_GET['ref']) ? $_GET['ref'] : '';
    $links = checkPageType($sessionData, 'confirmation.php');
    // Come up with tagline function;
    echo buildPageStart('confirmed');
    echo buildHeader($links);
    echo startMainSection();
    echo confirmationHandlers($sessionData, $refferer);
    echo endMainSection();
    echo buildFooter();
    echo buildHamburgerBtn();
    echo buildPageEnd();
?> 