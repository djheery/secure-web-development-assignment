<?php 
  require_once 'buildPage.php';
  require_once 'marketingBlock.php';
  require_once 'filmListingsTiles.php';
  require_once '../assets/src/getNavigationLinks.php';
  require_once '../assets/src/filmTiles.php';

  $tagline = "Welcome";
  $links = checkPageType('Logged Out', 'index.php');
  $pageId = $_GET['id'];

  echo buildPageStart($tagline);
  echo buildHeader($links);
  echo startMainSection();
?>
<!-- Main Page Showcase -->
<section id="booking-page" class="page-section bg-light-grey">
  <div class="inner-container flex">
    <div class="page-left">
      <div class="section-heading">
        <h1 class="heading-secondary text-upper mgb-mid">Book Your <span class="pastel-accent-clr">Film</span></h1>
      </div>
      <div class="section-text-block mgb-mid">
        <p>Your only a few steps away from booking your film time with us. We can't wait to see you. All you have to do is <span class="pastel-accent-clr bold">sign in</span>, tell us the <span class="pastel-accent-clr bold">date & time</span> you would like and that's it! <span class="bold">Free of charge!</span></p>
      </div>
    <?php
      echo filmBookingItem($pageId, 1);
    ?>
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