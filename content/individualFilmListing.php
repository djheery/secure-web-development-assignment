<?php 
  require_once '../assets/src/buildPage.php';
  require_once '../assets/src/databaseActions.php';
  require_once '../assets/src/filmListingsFunctions.php';
  require_once '../assets/src/getNavigationLinks.php';
  require_once '../assets/src/sessionFunctions.php';

  generateSession();
  $sessionData = getSessionData();
  // Add Check for login
  $tagline = "";
  $movie = getIndividualFilm($_GET['id']);
  $links = checkPageType($sessionData, 'index.php');
  echo buildPageStart($tagline);
  echo buildHeader($links);
  echo startMainSection();
  echo createIndividualFilmListing($movie[0]);
  echo buildFilmTiles("More <span class=\"pastel-accent-clr\">Films</span>");
  echo buildMarketingBlock();
  echo endMainSection();
  echo buildFooter();
  echo buildHamburgerBtn();
  echo buildPageEnd();
?>