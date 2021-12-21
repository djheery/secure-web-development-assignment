<?php 
  require_once "../assets/src/buildPage.php";
  $filePaths = filePaths();
  require_once "{$filePaths['scripts']}/preDatabaseInteraction.php";
  require_once "{$filePaths['scripts']}/filmListingsFunctions.php";
  require_once "{$filePaths['scripts']}/getNavigationLinks.php";
  require_once "{$filePaths['scripts']}/sessionFunctions.php";

  // Generate Session
  generateSession();
  $sessionData = getSessionData();
  // Get the validate the id and Get from database
  $movie = findTargetDatabaseQuery('individual-listing-page', $_GET['id']);
  if($movie == null) header("location:filmListings.php");
  // Get page for title
  $pageName = getPageName($_SERVER['PHP_SELF']);
  $navigationLinks = checkPageType($sessionData, $pageName);
  // Page Start (buildPage.php)
  echo buildPageStart(getPageTitle($pageName));
  echo buildHeader($navigationLinks);
  echo startMainSection();
  echo createIndividualFilmListing($movie);
  echo buildFilmTiles("More <span class=\"pastel-accent-clr\">Films</span>");
  echo buildMarketingBlock($sessionData);
  echo endMainSection();
  echo buildFooter($navigationLinks);
  // Build HamburgerMenu for mobile navigation
  echo buildHamburgerBtn();
  echo "<script src='/assets/src/js/mobile-nav.js'></script>";
  echo buildPageEnd();
?>