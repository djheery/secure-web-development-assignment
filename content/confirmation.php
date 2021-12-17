<?php
    require_once '../assets/src/buildPage.php';
    require_once '../assets/src/filmListingsFunctions.php';
    require_once '../assets/src/getNavigationLinks.php';
    require_once '../assets/src/confirmationHandlers.php';
    require_once '../assets/src/sessionFunctions.php';

    generateSession();
    $refferer = isset($_GET['ref']) ? $_GET['ref'] : '';
    if($refferer == 'delete-user') unsetDestroySession();
    $sessionData = getSessionData();
    $pageName = getPageName($_SERVER['PHP_SELF']);
    $links = checkPageType($sessionData, $pageName);
    echo buildPageStart(getPageTitle($pageName));
    echo buildHeader($links);
    echo startMainSection();
    echo confirmationHandlers($sessionData, $refferer);
    echo endMainSection();
    echo buildFooter($links);
    echo buildHamburgerBtn();
    echo "<script src='/swd-final-assignment/assets/src/js/mobile-nav.js'></script>";
    echo buildPageEnd();
?> 