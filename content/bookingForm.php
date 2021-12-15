<?php 
  require_once '../assets/src/buildPage.php';
  require_once '../assets/src/getNavigationLinks.php';
  require_once '../assets/src/filmListingsFunctions.php';
  require_once '../assets/src/sessionFunctions.php';

  generateSession();
  $sessionData = getSessionData();
  // Rework to check for login
  if($sessionData == false) header('location: loginForm.php');
  $tagline = "Welcome";
  $links = checkPageType($sessionData, 'individualFilmListing.php');
  $movie = getIndividualMovie($_GET['id']);
  if($movie == null) header("location:filmListings.php");
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
      <div class="error-block"></div>
    <?php
      echo filmBookingForm($movie);
    ?>
  </div>
</section>
<?php 
  echo buildFilmTiles("What's <span class=\"pastel-accent-clr\">On?</span>");
  echo buildMarketingBlock($sessionData);
  echo endMainSection();
  echo buildFooter();
  echo buildHamburgerBtn();
  echo "<script src='/swd-final-assignment/assets/src/js/mobile-nav.js'></script>";
  echo "<script src='/swd-final-assignment/assets/src/js/error-handling-ui.js'></script>";
  echo buildPageEnd();
?>
