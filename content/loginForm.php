<?php 
  require_once '../assets/src/buildPage.php';
  require_once '../assets/src/filmListingsFunctions.php';
  require_once '../assets/src/getNavigationLinks.php';
  require_once '../assets/src/sessionFunctions.php';

  generateSession();
  $sessionData = getSessionData();
  if($sessionData) header('location: accountSettings.php');
  $tagline = "Welcome";
  $links = checkPageType($sessionData, 'index.php');
  echo buildPageStart($tagline);
  echo buildHeader($links);
  echo startMainSection();
?>
    <section id="sign-up" class="page-section bg-light-grey">
      <div class="inner-container flex">
        <div class="page-left">
          <h1 class="heading-secondary text-upper mgb-large"><span class="pastel-accent-clr">Login</span> To Your<span class="pastel-accent-clr"> Account</span></h1>
          <div class="error-block"></div>
          <!-- Form -->
          <form action="../assets/src/validateForm.php" method="post">
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
  echo buildFooter();
  echo buildHamburgerBtn();
  echo "<script src='/swd-final-assignment/assets/src/js/error-handling-ui.js'></script>";
  echo "<script src='/swd-final-assignment/assets/src/js/mobile-nav.js'></script>";
  echo buildPageEnd();
?>