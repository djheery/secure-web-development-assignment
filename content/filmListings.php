<?php 
  require_once '../assets/src/buildPage.php';
  require_once '../assets/src/filmListingsFunctions.php';
  require_once '../assets/src/getNavigationLinks.php';
  require_once '../assets/src/databaseActions.php';
  require_once '../assets/src/sessionFunctions.php';

  generateSession();
  $sessionData = getSessionData();
  $tagline = "Whats On?";
  $links = checkPageType($sessionData, 'filmListings.php');
  echo buildPageStart($tagline);
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
        <!-- Film Search Criteria -->
      <section id="film-search-criteria" class="page-section bg-light-grey">
      <div class="inner-container flex">
        <div class="search-criteria-block">
          <div class="mgb-mid">
            <label for="choose-a-date" class="input-label  text-upper">Date</label>
          </div>
          <div class="select-container">
            <input type="date" name="date" id="date">
          </div>
        </div>
        <div class="search-criteria-block">
          <div class="mgb-mid">
            <label for="catagories" class="input-label  text-upper">Catagories</label>
          </div>
          <div class="select-container">
            <select name="catagories" id="catagories">
              <option value="family">Family</option>
              <option value="action">Action</option>
              <option value="thriller">Thriller</option>
              <option value="comedy">Comedy</option>
            </select>
          </div>
        </div>
        <div class="search-criteria-block">
          <div class="mgb-mid">
            <label for="search" class="input-label  text-upper">Search</label>
          </div>
          <div class="search-container">
            <input type="text" name="search" id="search">
          </div>
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