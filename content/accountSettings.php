<?php 
    require_once '../assets/src/buildPage.php';
    require_once '../assets/src/getNavigationLinks.php';
    require_once '../assets/src/accountSettingsFunctions.php';
    require_once '../assets/src/sessionFunctions.php';

    generateSession();
    $sessionData = getSessionData();
    // Add Check for login
    $ref = isset($_GET['ref']) ? $_GET['ref'] : '';
    $tagline = "Account Settings";
    $links = checkPageType($sessionData, 'index.php');
    echo buildPageStart($tagline);
    echo buildHeader($links);
    echo startMainSection();
  ?>
  <!-- Main Page Showcase -->
  <section id="adv-settings" class="page-section bg-light-grey">
      <div class="inner-container flex">
        <div class="page-left">
          <div class="section-heading">
            <h1 class="heading-secondary text-upper mgb-mid">Welcome Back <span class="pastel-accent-clr"><?php echo $sessionData['name'] ?></span></h1>
          </div>
          <div class="section-text-block mgb-mid">
            <p class="bold">Select from the options below:</p>
          </div>
          <section class="settings-links flex">
            <div class="settings-link-container mgb-small">
              <a href="?ref=view-bookings" class="bold adv-link">View Your Bookings</a>
              <div class="background-highlight bg-strong-orange"></div>
            </div>
            <div class="settings-link-container mgb-small">
              <a href="?ref=change-password" class="bold adv-link">Change Your Password</a>
              <div class="background-highlight bg-strong-orange"></div>
            </div>
            <div class="settings-link-container mgb-small">
              <a href="?ref=delete-account" class="bold adv-link">Delete Your Account</a>
              <div class="background-highlight bg-strong-orange"></div>
            </div>
            <div class="settings-link-container">
              <a href="filmListings.php" class="bold adv-link">Back to Film Listings</a>
              <div class="background-highlight bg-strong-orange"></div>
            </div>
          </section>
        </div>
        <div class="page-right flex">
            <?php 
                echo generateSideBox($ref, $sessionData);
            ?>
        </div>
      </div>
    </section>
  <?php 
    echo endMainSection();
    echo buildFooter();
    echo buildHamburgerBtn();
    echo buildPageEnd();
?>