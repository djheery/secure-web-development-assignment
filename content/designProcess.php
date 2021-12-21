<?php
  require_once "../assets/src/buildPage.php";
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
<section id="design-process" class="page-section bg-light-grey">
  <div class="inner-container">
    <h1 class="text-upper pastel-accent-clr">Design Process</h1>
    <p class="mgb-large">Below are some of the designs and wire frames I made before coding this assignment obvious changes have occured since the creation of these designs, such as the image usage and the implementation of pagination.</p>
    <div class="mgb-mid">
      <h2 class="pastel-accent-clr mgb-mid">Index Page Wire Frame</h2>
      <img src="/assets/images/Index-wireframe.png" alt="Index Page Wireframe">
    </div>
    <div class="mgb-mid">
      <h2 class="pastel-accent-clr mgb-mid">Index Page Full Page Design</h2>
      <img src="/assets/images/Index-full-design.png" alt="Index Page Wireframe">
    </div>
    <div class="mgb-mid">
      <h2 class="pastel-accent-clr mgb-mid">Film Listings Wire Frame</h2>
      <img src="/assets/images/Film-Listings-wireframe.png" alt="Film Listings Wireframe">
    </div>
    <div class="mgb-mid">
      <h2 class="pastel-accent-clr mgb-mid">Film Listings Full Page Design</h2>
      <img src="/assets/images/Film-Listings-Full-Design.png" alt="Film Listings Wireframe">
    </div>
    <div class="mgb-mid">
      <h2 class="pastel-accent-clr mgb-mid">Individual Film Listings Wireframe</h2>
      <img src="/assets/images/Individual-Film-Listing-Wireframe.png" alt="Film Listings Wireframe">
    </div>
    <div class="mgb-mid">
      <h2 class="pastel-accent-clr mgb-mid">Sign up & account settings wireframe</h2>
      <img src="/assets/images/sign-up-adv-settings-wireframe.png" alt="Sign Up & Account Settings">
    </div>
    <div class="mgb-mid">
      <h2 class="pastel-accent-clr mgb-mid">Sign Up Form Full Design</h2>
      <img src="/assets/images/Sign-up-form-full-design.png" alt="Sign Up full design">
    </div>
    <div class="mgb-mid">
      <h2 class="pastel-accent-clr mgb-mid">Settings Wireframe</h2>
      <img src="/assets/images/adv-settings-wireframe.png" alt="Individual Listings Wireframe">
    </div>
    <div class="mgb-mid">
      <h2 class="pastel-accent-clr mgb-mid">Settings Full Design</h2>
      <img src="/assets/images/adv-set-fd.png" alt="Settings Full design">
    </div>

  </div>
</section>
<?php 
  echo endMainSection();
  echo buildFooter($links);
  echo buildHamburgerBtn();
  echo "<script src='/assets/src/js/mobile-nav.js'></script>";
  echo buildPageEnd();
?>