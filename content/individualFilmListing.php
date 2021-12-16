<?php 
  require_once "../assets/src/buildPage.php";
  $filePaths = filePaths();
  require_once "{$filePaths['scripts']}/filmListingsFunctions.php";
  require_once "{$filePaths['scripts']}/getNavigationLinks.php";
  require_once "{$filePaths['scripts']}/databaseActions.php";
  require_once "{$filePaths['scripts']}/sessionFunctions.php";

  generateSession();
  $sessionData = getSessionData();
  $movie = getIndividualMovie($_GET['id']);
  if($movie == null) header("location:filmListings.php");
  $pageName = getPageName($_SERVER['PHP_SELF']);
  $links = checkPageType($sessionData, $pageName);
  echo buildPageStart(getPageTitle($pageName));
  echo buildHeader($links);
  echo startMainSection();
  echo createIndividualFilmListing($movie);
  echo buildFilmTiles("More <span class=\"pastel-accent-clr\">Films</span>");
  echo buildMarketingBlock($sessionData);
  echo endMainSection();
  echo buildFooter();
  echo buildHamburgerBtn();
  echo "<script src='/swd-final-assignment/assets/src/js/mobile-nav.js'></script>";
  echo buildPageEnd();
?>