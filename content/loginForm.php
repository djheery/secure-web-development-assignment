<?php 
  require_once "../assets/src/buildPage.php";
  $filePaths = filePaths();
  require_once "{$filePaths['scripts']}/filmListingsFunctions.php";
  require_once "{$filePaths['scripts']}/getNavigationLinks.php";
  require_once "{$filePaths['scripts']}/sessionFunctions.php";

  generateSession();
  $sessionData = getSessionData();
  if($sessionData) header('location: accountSettings.php');
  $pageName = getPageName($_SERVER['PHP_SELF']);
  $errors = getErrorQueries($_SERVER['QUERY_STRING']);
  $links = checkPageType($sessionData, $pageName);
  echo buildPageStart(getPageTitle($pageName));
  echo buildHeader($links);
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
  echo buildFooter($links);
  echo buildHamburgerBtn();
  echo "<script src='/swd-final-assignment/assets/src/js/mobile-nav.js'></script>";
  echo buildPageEnd();
?>