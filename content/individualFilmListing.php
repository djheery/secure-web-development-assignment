<?php 
  require_once '../assets/src/buildPage.php';
  require_once '../assets/src/databaseActions.php';
  require_once '../assets/src/filmListingsFunctions.php';
  require_once '../assets/src/getNavigationLinks.php';
  require_once '../assets/src/sessionFunctions.php';

  generateSession();
  $sessionData = getSessionData();
  $tagline = "";
  $movie = getIndividualMovie($_GET['id']);
  if($movie == null) header("location:filmListings.php");
  $links = checkPageType($sessionData, 'index.php');
  echo buildPageStart($tagline);
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