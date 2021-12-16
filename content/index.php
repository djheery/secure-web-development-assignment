<?php
  require_once "../assets/src/buildPage.php";
  $filePaths = filePaths();
  require_once "{$filePaths['scripts']}/filmListingsFunctions.php";
  require_once "{$filePaths['scripts']}/getNavigationLinks.php";
  require_once "{$filePaths['scripts']}/sessionFunctions.php";

  generateSession();
  $sessionData = getSessionData();
  $pageName = getPageName($_SERVER['PHP_SELF']);
  $links = checkPageType($sessionData, $pageName);
  echo buildPageStart(getPageTitle($pageName));
  echo buildHeader($links);
  echo startMainSection();
?>
<!-- Main Page Showcase -->
<section id="index-showcase" class="showcase">
  <div class="background-image-filter"></div>
  <div class="inner-container flex central-content">
    <div class="showcase-title text-center" role="img" aria-label="Advertisement for the new James Bond Film">
      <h1 class="heading-primary text-upper">James Bond</h1>
      <h3 class="sub-heading text-upper">No Time To Die</h3>
    </div>
  </div>
</section>
<?php 
  echo buildFilmTiles("What's <span class=\"pastel-accent-clr\">On?</span>");
  echo buildMarketingBlock($sessionData);
  echo endMainSection();
  echo buildFooter();
  echo buildHamburgerBtn();
  echo "<script src='/swd-final-assignment/assets/src/js/mobile-nav.js'></script>";
  echo buildPageEnd();
?>