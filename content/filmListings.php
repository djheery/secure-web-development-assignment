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
            <p class="mgb-large">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptates doloribus ullam repellendus at esse id similique illo aperiam perferendis voluptas magnam quia est in soluta voluptate ea quis nihil dolor dolores, odio repudiandae? Numquam, omnis porro esse quis eaque error nihil quos et eligendi laboriosam ullam amet. Illo quod tenetur animi officiis magnam minus numquam quo. Rerum </p>
            <h3 class="sub-heading"><span class='pastel-accent-clr'>Location:</span> Newcastle Upon Tyne</h3>
        </div>
        </div>
    </section>

<?php 
  echo createFilmListingsSection($sessionData);
  echo buildMarketingBlock($sessionData);
  echo endMainSection();
  echo buildFooter();
  echo buildHamburgerBtn();
  echo "<script src='/swd-final-assignment/assets/src/js/mobile-nav.js'></script>";
  echo buildPageEnd();
?>