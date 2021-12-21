<?php 
  require_once "../assets/scripts/buildPage.php";
  $filePaths = filePaths();
  require_once "{$filePaths['scripts']}/preDatabaseInteraction.php";
  require_once "{$filePaths['scripts']}/filmListingsFunctions.php";
  require_once "{$filePaths['scripts']}/getNavigationLinks.php";
  require_once "{$filePaths['scripts']}/sessionFunctions.php";
  // Session Data
  generateSession();
  $sessionData = getSessionData();
  // redirect if session is not found
  if($sessionData == false) header('location: loginForm.php');
  // get Page name for title
  $pageName = getPageName($_SERVER['PHP_SELF']);
  $navigationLinks = checkPageType($sessionData, $pageName);
  // Check film id in database act accordingly with the result
  $movie = findTargetDatabaseQuery('individual-listing-page', $_GET['id']);
  if($movie == null) header("location:filmListings.php");
  // Check for errors to be displayed 
  $errors = getErrorQueries($_SERVER['QUERY_STRING']);
  // Build the page
  echo buildPageStart(getPageTitle($pageName));
  echo buildHeader($navigationLinks);
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
      <div class="error-block">
      <?php 
        if($errors) echo showFormErrors($errors); 
      ?>
      </div>
    <?php
      echo filmBookingForm($movie);
    ?>
  </div>
</section>
<?php 
  echo buildFilmTiles("What's <span class=\"pastel-accent-clr\">On?</span>");
  echo buildMarketingBlock($sessionData);
  echo endMainSection();
  echo buildFooter($navigationLinks);
  echo buildHamburgerBtn();
  echo "<script src='../assets/scripts/js/mobile-nav.js'></script>";
  echo buildPageEnd();
?>
