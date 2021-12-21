<?php
  require_once "../assets/scripts/buildPage.php";
  $filePaths = filePaths();
  require_once "{$filePaths['scripts']}/filmListingsFunctions.php";
  require_once "{$filePaths['scripts']}/getNavigationLinks.php";
  require_once "{$filePaths['scripts']}/sessionFunctions.php";
  // Session Data
  generateSession();
  $sessionData = getSessionData();
  $pageName = getPageName($_SERVER['PHP_SELF']);

  $links = checkPageType($sessionData, $pageName);
  // Build Page (buildPage.php)
  echo buildPageStart(getPageTitle($pageName));
  echo buildHeader($links);
  echo startMainSection();
?>
<!-- Main Page Showcase -->
<section id="index-showcase" class="showcase">
  <div class="background-image-filter"></div>
  <div class="inner-container flex central-content">
    <div class="showcase-title text-center" role="img" aria-label="Advertisement for the new James Bond Film">
      <h1 class="heading-primary text-upper">Tears of Steel</h1>
      <h3 class="sub-heading text-upper">Metal Will Rain Down Upon You</h3>
    </div>
  </div>
</section>
<?php 
  echo buildFilmTiles("What's <span class=\"pastel-accent-clr\">On?</span>");
  echo buildMarketingBlock($sessionData);
  echo endMainSection();
  echo buildFooter($links);
  echo buildHamburgerBtn();
  echo "<script src='../assets/scripts/js/mobile-nav.js'></script>";
  echo buildPageEnd();
?>