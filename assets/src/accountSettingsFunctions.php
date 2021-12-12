<?php
  function generateSideBox($refferer, $sessionData) {
    $boxContent = boxStart();
    switch ($refferer) {
      case 'change-password' :
        $boxContent .= changePassword();
        break;
      case 'delete-account' :
        $boxContent .= deleteAccount();
        break;
      case 'give-full-detail' :
        break;
      default :
        $boxContent .= veiwBookings($sessionData);
    }

    $boxContent .= boxEnd();
    return $boxContent;
  }

  function boxStart() {
    $boxStart = <<<BOXSTART
    <div class="dynamic-box-container">
    <div class="box-background bg-strong-orange"></div>
    <div class="dynamic-box bg-off-black">
    BOXSTART;
    return $boxStart;
  }

  function boxEnd() {
    return "</div>";     
  }

  function veiwBookings($sessionData) {
    if($sessionData['bookings']) {
      $content = <<<BOXTITLE
        <div class="mgb-mid">
          <p class="bold">Save the <span class="pastel-accent-clr">date...</span></p>
        </div>
        <div class="section-text-box mgb-mid">
          <p class="bold mgb-mid">Your are booked to see...</p>
          <ul class="flex bookings-list">
        BOXTITLE;
      foreach($sessionData['bookings'] as $b) {
       
        $content .= <<<LISTITEM
        <li>
          <a href='individualFilmListing.php?id={$b['movieID']}'>
            <span class='bold'>{$b['screening_date_time']} - </span><br>{$b['movie_name']}
          </a>
        </li>
        LISTITEM;
      }
      $content .= "</ul></div>";
    } else {
      $content = <<<CONTENT
      <div class="mgb-mid">
          <p class="">You currently have no bookings!!</span></p>
      </div>
      <div class="section-text-box mgb-mid">
        <p class="bold mgb-small">Go to our film listings page and book a film!</p>
      </div>
      CONTENT;
    }
    return $content;
  }

  function changePassword() {
    $content = <<<PSWDFORM
    <div class="mgb-mid">
      <p class="bold">Change Your <span class="pastel-accent-clr">password...</span></p>
    </div>
    <form action="../assets/src/validateForm.php" method="post">
      <div class="form-field-container">
        <div class="mgb-small">
          <label for="old-password" class="input-label">Old Password</label>
        </div>
        <div class="input-container">
          <input type="password" id="old-password" name="old-password">
        </div>
      </div>
      <div class="form-field-container">
        <div class="mgb-small">
          <label for="password" class="input-label">New Password</label>
        </div>
        <div class="input-container">
          <input type="password" id="password" name="password">
        </div>
      </div>
      <div class="form-field-container mgb-mid">
        <div class="mgb-small">
          <label for="confirm-password" class="input-label">Confirm New Password</label>
        </div>
        <div class="input-container">
          <input type="password" id="confirm-password" name="confirm-password">
        </div>
      </div>
      <div class="buttons-container flex">
          <button id="submit" type="submit" class="btn bg-strong-orange">Change Password</button>
      </div>
      <input type="hidden" name="form-path" value="accountSettings.php?ref=change-password">
      <input type="hidden" name="form-name" value="change-password">
    </form>
    PSWDFORM;

    return $content;
  }

  function deleteAccount() {
    $content = <<<PSWDFORM
    <div class="mgb-mid">
      <p class="bold text-upper mgb-small">I can't live, if living is without<span class="pastel-accent-clr"> you...</span></p>
      <p>Delete your account?</p>
    </div>
    <form action="../assets/src/validateForm.php" method="post">
      <div class="form-field-container">
        <div class="mgb-small">
          <label for="password" class="input-label">Password</label>
        </div>
        <div class="input-container">
          <input type="password" id="password" name="password">
        </div>
      </div>
      <div class="form-field-container mgb-mid">
        <div class="mgb-small">
          <label for="confirm-password" class="input-label">Confirm New Password</label>
        </div>
        <div class="input-container">
          <input type="password" id="confirm-password" name="confirm-password">
        </div>
      </div>
      <div class="buttons-container flex">
          <button id="submit" type="submit" class="btn bold bg-warning-red">Delete Account</button>
      </div>
      <input type="hidden" name="form-path" value="accountSettings.php?ref=delete-account">
      <input type="hidden" name="form-name" value="delete-user">
    </form>
    PSWDFORM;

    return $content;
  }

  function updateAccountDetails() {

  }
?>