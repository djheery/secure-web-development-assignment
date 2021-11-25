<?php 
  require_once 'buildPage.php';
  require_once 'filmTiles.php';
  require_once 'marketingBlock.php';
  require_once 'getNavigationLinks.php';

  $tagline = "Whats On?";
  $links = checkPageType('Logged Out', 'filmListings.php');
  echo buildPageStart($tagline);
  echo buildHeader($links);
  echo startMainSection();
?>
<!-- Main Page Showcase -->
<section id="index-showcase" class="showcase">
  <div class="background-image-filter"></div>
  <div class="inner-container flex central-content">
    <div class="showcase-title text-center">
      <h1 class="heading-primary text-upper">What Do You Want</h1>
      <h3 class="sub-heading text-upper">No Time To Die</h3>
    </div>
  </div>
</section>
<?php 
  echo buildFilmTiles("Films <span class=\"pastel-accent-clr\">Like</span> This");
  echo buildMarketingBlock();
  echo endMainSection();
  echo buildFooter();
  echo buildHamburgerBtn();
  echo buildPageEnd();
?>