<?php
  require_once 'buildPage.php';
  require_once 'sessionFunctions.php';

  function confirmationHandlers($sess, $refferer) {
    // Find this function in buildPage.php - it is responsible for sanitizing the output
    $safeOutput = $sess ? makeOutputSafe($sess) : null;
    $pageContent = "<section id='confirmation-showcase' class='bg-light-grey showcase'><div class='inner-container flex'><div class='page-left'>";
    // simple switch statement to define the output of a confirmation handler
    switch($refferer) {
      case 'booking-form' :
          $pageContent .= <<<CONTENT
              <h1  class="heading-primary text-upper">Booking <span class="pastel-accent-clr">Confirmed!</h1>
              <p>{$safeOutput['name']}</span>, your booking has been confirmed we look forward to seeing you soon</p>
CONTENT;
          break;
      case 'sign-up' :
          $pageContent .= <<<CONTENT
            <h1 class="heading-primary text-upper">Welcome <span class="pastel-accent-clr">{$safeOutput['name']}</span></h1>
            <p>You can now book films, view your account and read my security report!</p>
CONTENT;
          break;
      case 'login' :
          $pageContent .= <<<CONTENT
            <h1 class="heading-primary text-upper">Welcome <span class="pastel-accent-clr">{$safeOutput['name']}</span></h1>
            <p>You can now book films, view your account and read my security report!</p>
CONTENT;
          break;
      case 'logout-user' :
        unsetDestroySession();
        header('location: /swd-final-assignment/content/index.php');
        // header('location: /content/index.php');
        break;
      case 'change-password' :
        $pageContent .= <<<CONTENT
          <h1 class="heading-primary text-upper">Password<span class="pastel-accent-clr"> Succesfully Changed</span></h1>
          <p>You have changed your password, please make sure to use this password upon sign in, in future.</p>
CONTENT;
        break;
      case 'delete-user' :
        $pageContent .= <<<CONTENT
          <h1 class="heading-primary text-upper"><span class="pastel-accent-clr">Auf Wiedersehen</span>, Goodbye?</h1>
          <p>We are sorry you had to go, we will be ready to take you back whenever you are ready.</p>
CONTENT;
        break;
      case 'add-movies' : 
        $pageContent .= <<<CONTENT
        <h1 class="heading-primary text-upper"><span class="pastel-accent-clr">Booking <span class="pastel-accent-clr">Added</span></h1>
        <p>Listing Sucessfully added</p>
        <div class="btn-container">
          <a class="btn bg-strong-orange" href="addMovieForm.php">Add Another Movie</a>
        </div>
CONTENT;
      default :
        $pageContent .= <<<CONTENT
          <h1 class="heading-primary text-upper">Well Done... <span class="pastel-accent-clr">For something</span></h1>
          <p>I don't know what you have confirmed... but well done for it!</p>
CONTENT;
        break;
      };
    $pageContent .= "</div></div></section>";
    return $pageContent;
  }
?>