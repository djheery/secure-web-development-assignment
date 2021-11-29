<?php 
  require_once 'buildPage.php';
  require_once 'marketingBlock.php';
  require_once '../assets/src/filmTiles.php';
  require_once '../assets/src/getNavigationLinks.php';

  $tagline = "Welcome";
  $links = checkPageType('Logged Out', 'index.php');
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
  echo buildMarketingBlock();
  echo endMainSection();
  echo buildFooter();
  echo buildHamburgerBtn();
  echo buildPageEnd();
?>