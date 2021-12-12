<?php
  require_once 'sessionFunctions.php';

  function confirmationHandlers($sess, $refferer) {
    $pageContent = "<section id='confirmation-showcase' class='bg-light-grey showcase'><div class='inner-container flex'>";
    switch($refferer) {
      case 'booking-form' :
          $pageContent .= <<<CONTENT
              <h1  class="heading-primary text-upper">Booking Confirmed!</h1>
              <p><span class="pastel-accent-clr">{$sess['name']}</span>, your booking has been confirmed we look forward to seeing you soon</p>
          CONTENT;
          break;
      case 'sign-up' :
          $pageContent .= <<<CONTENT
            <h1 class="heading-primary text-upper">Welcome <span class="pastel-accent-clr">{$sess['name']}</span></h1>
            <p>You can now book films, view your account and read my security report!</p>
          CONTENT;
          break;
      case 'login' :
          $pageContent .= <<<CONTENT
            <h1 class="heading-primary text-upper">Welcome <span class="pastel-accent-clr">{$sess['name']}</span></h1>
            <p>You can now book films, view your account and read my security report!</p>
          CONTENT;
          break;
      case 'logout-user' :
        unsetDestroySession();
        header('location: /swd-final-assignment/content/index.php');
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
      default :
        $pageContent .= <<<CONTENT
          <h1 class="heading-primary text-upper">Well Done... <span class="pastel-accent-clr">For something</span></h1>
          <p>I don't know what you have confirmed... but well done for it!</p>
        CONTENT;
        break;
      };
    $pageContent .= "</div></section>";
    return $pageContent;
  }
?>