<?php
  function confirmationHandlers($sess, $refferer) {
    $pageContent = "<section id='confirmation-showcase' class='bg-light-grey showcase'>";
    switch($refferer) {
      case 'bookingForm.php' :
          $pageContent .= <<<CONTENT
              <h1  class="heading-primary text-upper">Booking Confirmed!</h1>
              <p><span class="pastel-accent-clr">{$sess['name']}</span>, your booking has been confirmed we look forward to seeing you soon</p>
          CONTENT;
          break;
      case 'signUpForm.php' :
          $pageContent .= <<<CONTENT
            <h1 class="heading-primary text-upper">Welcome <span class="pastel-accent-clr">{$sess['name']}</span></h1>
            <p>You can now book films, view your account and read my security report!</p>
          CONTENT;
          break;
      case 'signUpForm.php' :
          $pageContent .= <<<CONTENT
            <h1 class="heading-primary text-upper">Welcome <span class="pastel-accent-clr">{$sess['name']}</span></h1>
            <p>You can now book films, view your account and read my security report!</p>
          CONTENT;
          break;
      };
    $pageContent .= "</section>";
    return $pageContent;
  }
?>