<?php 
  require_once '../assets/src/buildPage.php';
  require_once '../assets/src/filmListingsFunctions.php';
  require_once '../assets/src/getNavigationLinks.php';
  require_once '../assets/src/sessionFunctions.php';

  generateSession();
  $sessionData = getSessionData();
  // Add Check for login
  $tagline = "Welcome";
  $links = checkPageType($sessionData, 'index.php');
  echo buildPageStart($tagline);
  echo buildHeader($links);
  echo startMainSection();
?>
<!-- Main Page Showcase -->
<section id="index-showcase" class="showcase">
  <div class="background-image-filter"></div>
  <div class="inner-container flex central-content">
    <div class="showcase-title text-center">
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
  echo buildPageEnd();
?>