<?php
    require_once '../assets/src/buildPage.php';
    require_once '../assets/src/filmListingsFunctions.php';
    require_once '../assets/src/getNavigationLinks.php';
    require_once '../assets/src/confirmationHandlers.php';
    require_once '../assets/src/sessionFunctions.php';
    generateSession();
    $sess = getSessionData();
    $refferer = $_GET['ref'];
    $links = checkPageType('Logged Out', 'confirmation.php');
    // Come up with tagline function;
    echo buildPageStart('confirmed');
    echo buildHeader($links);
    echo startMainSection();
    echo confirmationHandlers($sess, $refferer);
    echo endMainSection();
    echo buildFooter();
    echo buildHamburgerBtn();
    echo buildPageEnd();
?> 