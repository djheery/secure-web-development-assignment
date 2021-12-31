<?php
    require_once '../assets/scripts/buildPage.php';
    $filePaths = filePaths();
    require_once "{$filePaths['scripts']}/filmListingsFunctions.php";
    require_once "{$filePaths['scripts']}/getNavigationLinks.php";
    require_once "{$filePaths['scripts']}/confirmationHandlers.php";
    require_once "{$filePaths['scripts']}/sessionFunctions.php";
    // Session Data
    generateSession();
    // Get the page refferer to show the correct confirmation handler
    $refferer = isset($_GET['ref']) ? $_GET['ref'] : '';
    if($refferer == 'delete-user') unsetDestroySession();
    // Get the Session Data after the above function so that the user is not logged in
    $sessionData = getSessionData();
    print_r($sessionData);
    // Get page name for title
    $pageName = getPageName($_SERVER['PHP_SELF']);
    $navigationLinks = checkPageType($sessionData, $pageName);
    echo buildPageStart(getPageTitle($pageName));
    echo buildHeader($navigationLinks);
    echo startMainSection();
    echo confirmationHandlers($sessionData, $refferer);
    echo endMainSection();
    echo buildFooter($navigationLinks);
    echo buildHamburgerBtn();
    echo "<script src='../assets/scripts/js/mobile-nav.js'></script>";
    echo buildPageEnd();
?> 