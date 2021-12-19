<?php 
  require_once "../assets/src/buildPage.php";
  // Promote easy file path change if needed
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
          <h1 class="heading-secondary text-upper mgb-large">Sign <span class="pastel-accent-clr">Up</span> For<span class="pastel-accent-clr"> Cinema Club</span></h1>
          <!-- Form -->
          <div class="error-block">
          <?php 
              if($errors) echo showFormErrors($errors); 
            ?>
          </div>
          <form action="../assets/src/validateForm.php" method="post" class="form-block">
            <div class="two-input-row mgb-mid flex">
              <div class="form-field-container">
                <div class="mgb-small">
                  <label for="first-name" class="input-label">First Name</label>
                </div>
                <div class="input-container">
                  <input type="text" id="first-name" name="first-name">
                </div>
              </div>
              <div class="form-field-container">
                <div class="mgb-small">
                  <label for="last-name" class="input-label">Last Name</label>
                </div>
                <div class="input-container">
                  <input type="text" id="last-name" name="last-name" >
                </div>
              </div>
            </div>
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
                <label for="confirm-email" class="input-label">Confirm Email</label>
              </div>
              <div class="input-container">
                <input type="email" id="confirm-email" name="confirm-email">
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
            <div class="form-field-container mgb-large">
              <div class="mgb-small">
                <label for="confirm-password" class="input-label">Confirm Password</label>
              </div>
              <div class="input-container">
                <input type="password" id="confirm-password" name="confirm-password">
              </div>
            </div>
            <div class="buttons-container flex">
                <button aria-label="Submit sign up form" id="submit" type="submit" class="btn bg-strong-orange">Sign Up Now</button>
              <div class="text-btn">
                <a href="loginForm.php" aria-label="Login">Already have an account? Click here to login</a>
              </div>
            </div>
            <input type="hidden" name="form-path" value="signUpForm.php">
            <input type="hidden" name="form-name" value="sign-up">
          </form>
        </div>
        <div class="page-right">
          <img aria-hidden="true" src="../assets/images/camera-opperator-illustration.png" alt="" class='camera-operator-illustration'>
        </div>
      </div>
    </section>
<?php 
  echo endMainSection();
  echo buildFooter($navigationLinks);
  // Mobile Hamburger Link for main Navigation
  echo buildHamburgerBtn();
  echo "<script src='/swd-final-assignment/assets/src/js/mobile-nav.js'></script>";
  echo buildPageEnd();
?>