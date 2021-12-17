<?php 
  require_once '../assets/src/buildPage.php';
  require_once '../assets/src/filmListingsFunctions.php';
  require_once '../assets/src/getNavigationLinks.php';
  require_once '../assets/src/databaseActions.php';
  require_once '../assets/src/sessionFunctions.php';

  generateSession();
  $sessionData = getSessionData();
  $pageName = getPageName($_SERVER['PHP_SELF']);
  $links = checkPageType($sessionData, $pageName);
  echo buildPageStart(getPageTitle($pageName));
  echo buildHeader($links);
  echo startMainSection();
?>
<!-- Main Page Showcase -->
<section id="film-listings-showcase" class="page-section showcase">
      <div class="background-image-filter"></div>
      <div class="inner-container flex">
        <div class="section-heading">
          <h1 class="heading-primary text-upper mgb-large">What's <span class="pastel-accent-clr">On?</span></h1>
        </div>
        <div class="section-text-block">
            <p class="mgb-large">Find the latest and greatest of film with us. See our listings below to get started with booking your first film. You must have an account to book a movie with us, so once that's ready, book yourself a seat, and get ready for the galaxies top film experience</p>
            <h3 class="sub-heading"><span class='pastel-accent-clr'>Location:</span> Newcastle Upon Tyne</h3>
        </div>
        </div>
    </section>

<?php 
  echo createFilmListingsSection($sessionData);
  echo buildMarketingBlock($sessionData);
  echo endMainSection();
  echo buildFooter($links);
  echo buildHamburgerBtn();
  echo "<script src='/swd-final-assignment/assets/src/js/mobile-nav.js'></script>";
  echo buildPageEnd();
?>