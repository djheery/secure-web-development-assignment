<?php 
  require_once '../assets/src/buildPage.php';
  require_once '../assets/src/filmListingsFunctions.php';
  require_once '../assets/src/getNavigationLinks.php';
  require_once '../assets/src/sessionFunctions.php';
  require_once '../assets/src/sessionFunctions.php';

  generateSession();
  $sessionData = getSessionData();
  $pageName = getPageName($_SERVER['PHP_SELF']);
  $links = checkPageType($sessionData, $pageName);
  $errors = getErrorQueries($_SERVER['QUERY_STRING']);
  
  echo buildPageStart(getPageTitle($pageName));
  echo buildHeader($links);
  echo startMainSection();
?>
    <section id="sign-up" class="page-section bg-light-grey">
      <div class="inner-container flex">
        <div class="page-left">
          <h1 class="heading-secondary text-upper mgb-large">Add <span class="pastel-accent-clr">A Movie<span class="pastel-accent-clr"></h1>
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
                  <label for="movie-name" class="input-label">Movie Name</label>
                </div>
                <div class="input-container">
                  <input type="text" id="movie-name" name="movie-name">
                </div>
              </div>
              <div class="form-field-container">
                <div class="mgb-small">
                  <label for="director" class="input-label">Director</label>
                </div>
                <div class="input-container">
                  <input type="text" id="director" name="director">
                </div>
              </div>
              <div class="form-field-container">
                <div class="mgb-small">
                  <label for="duration" class="input-label">Duration</label>
                </div>
                <div class="input-container">
                  <input type="text" id="duration" name="duration">
                </div>
              </div>
              <div class="form-field-container">
                <div class="mgb-small">
                  <label for="description" class="input-label">Description</label>
                </div>
                <div class="input-container">
                  <textarea name="description" id="description" cols="30" rows="10"></textarea>
                </div>
              </div>
            </div>
            <div class="form-field-container mgb-mid">
              <div class="mgb-small">
                <label for="price" class="input-label">Price</label>
              </div>
              <div class="input-container">
                <input type="number" id="price" name="price" step="0.000000001">
              </div>
            </div>
            <div class="form-field-container flex mgb-mid">
              <div class="mgb-small">               
                <label for="rating" class="input-label">Rating</label>
              </div>
              <div class="select-container">
                <select name="rating" id="rating">
                  <option value="pg">PG</option>
                  <option value="12">12</option>
                  <option value="15">15</option>
                  <option value="18">18</option>
                </select>
              </div>
            </div>
            <div class="form-field-container mgb-mid">
              <div class="mgb-small">
                <label for="img-path" class="input-label">Image Path</label>
              </div>
              <div class="input-container">
                <input type="text" id="img-path" name="img-path">
              </div>
            </div>
            <div class="buttons-container flex">
                <button id="submit" type="submit" class="btn bg-strong-orange">Add Movie</button>
            </div>
            <input type="hidden" name="form-path" value="addMovieForm.php">
            <input type="hidden" name="form-name" value="add-movie">
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
  echo "<script src='/swd-final-assignment/assets/src/js/error-handling-ui.js'></script>";
  echo "<script src='/swd-final-assignment/assets/src/js/mobile-nav.js'></script>";
  echo buildPageEnd();
?>