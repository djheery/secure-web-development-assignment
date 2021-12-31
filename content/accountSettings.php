<?php
    require_once '../assets/scripts/buildPage.php';
    $filePaths = filePaths();
    require_once "{$filePaths['scripts']}/accountSettingsFunctions.php";
    require_once "{$filePaths['scripts']}/getNavigationLinks.php";
    require_once "{$filePaths['scripts']}/sessionFunctions.php"; 

    generateSession();
    $sessionData = getSessionData();
    if($sessionData == false) header('location: loginForm.php');
    $ref = isset($_GET['ref']) ? $_GET['ref'] : '';
    $pageName = getPageName($_SERVER['PHP_SELF']);
    $links = checkPageType($sessionData, $pageName);
    $errors = getErrorQueries($_SERVER['QUERY_STRING']);
    // Build Page (buildPage.php)
    print_r($sessionData['bookings']);
    echo buildPageStart(getPageTitle($pageName));
    echo buildHeader($links);
    echo startMainSection();
  ?>
  <!-- Main Page Showcase -->
  <section id="adv-settings" class="page-section bg-light-grey">
      <div class="inner-container flex">
        <div class="page-left">
          <div class="section-heading">
            <h1 class="heading-secondary text-upper mgb-mid">Welcome Back <span class="pastel-accent-clr">
              <?php 
                echo htmlspecialchars($sessionData['name']) ?>
              </span>
            </h1>
          </div>
          <div class="section-text-block mgb-mid">
            <p class="bold">Select from the options below:</p>
          </div>
          <div class="settings-links flex">
           <?php
             echo createAccountSettingsLinks($ref)
           ?>
          </div>
        </div>
        <div class="page-right flex">
            <?php 
                echo generateSideBox($ref, $sessionData, $errors);
            ?>
        </div>
      </div>
    </div>
    </section>
  <?php 
    echo endMainSection();
    echo buildFooter($links);
    echo buildHamburgerBtn();
    echo "<script src='../assets/scripts/js/mobile-nav.js'></script>";;
    echo buildPageEnd();
?>