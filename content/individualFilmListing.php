<?php 
  require_once 'buildPage.php';
  require_once 'marketingBlock.php';
  require_once 'filmListingsTiles.php';
  require_once '../assets/src/databaseActions.php';
  require_once '../assets/src/filmTiles.php';
  require_once '../assets/src/getNavigationLinks.php';
  
  $tagline = "";
  $movie = getIndividualFilm($_GET['id']);
  $links = checkPageType('Logged Out', 'index.php');
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