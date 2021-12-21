<?php 
  require_once "../assets/src/buildPage.php";
  $filePaths = filePaths();
  require_once "{$filePaths['scripts']}/filmListingsFunctions.php";
  require_once "{$filePaths['scripts']}/getNavigationLinks.php";
  require_once "{$filePaths['scripts']}/sessionFunctions.php";

  // Session information
  generateSession();
  $sessionData = getSessionData();
  if($sessionData) header('location: accountSettings.php');
  // Get Page Name for Page Title
  $pageName = getPageName($_SERVER['PHP_SELF']);
  // Error Handling
  $errors = getErrorQueries($_SERVER['QUERY_STRING']);
  // Navigation
  $navigationLinks = checkPageType($sessionData, $pageName);

  // Start Page Build (buildPage.php)
  echo buildPageStart(getPageTitle($pageName));
  echo buildHeader($navigationLinks);
  echo startMainSection();
?>
    <section id="sign-up" class="page-section bg-light-grey">
      <div class="inner-container flex">
        <div class="page-left">
          <h1 class="heading-secondary text-upper mgb-large"><span class="pastel-accent-clr">Login</span> To Your<span class="pastel-accent-clr"> Account</span></h1>
          <div class="error-block">
            <?php 
              if($errors) echo showFormErrors($errors); 
            ?>
          </div>
          <!-- Form -->
          <form action="../assets/src/validateForm.php" method="post">
            <fieldset>
              <legend class="mgb-mid">Login Details</legend>
              <div class="form-field-container mgb-mid">
                <div class="mgb-small">
                  <label for="email" class="input-label">Email Address</label>
                </div>
                <div class="input-container">
                  <input type="email" id="email" name="email">
                </div>
              </div>
              <div class="form-field-container mgb-mid">
                <div class="mgb-small">
                  <label for="password" class="input-label">Password</label>
                </div>
                <div class="input-container">
                  <input type="password" id="password" name="password">
                </div>
              </div>
            </fieldset>
            <input type="hidden" name="form-path" id="form-name" value="loginForm.php">
            <input type="hidden" name="form-name" value="login">
            <div class="buttons-container flex">
              <button id="submit" type="submit" class="btn bg-strong-orange">Login</button>
              <div class="text-btn">
                <a href="signUpForm.php">Don't have an account? Click here to Sign Up</a>
              </div>
            </div>
          </form>
        </div>
        <div class="page-right">
          <img src="../assets/images/camera-opperator-illustration.png" alt="" class='camera-operator-illustration'>
        </div>
      </div>
    </section>
<?php 
  echo endMainSection();
  echo buildFooter($navigationLinks);
  echo buildHamburgerBtn();
  echo "<script src='/assets/src/js/mobile-nav.js'></script>";
  echo buildPageEnd();
?>