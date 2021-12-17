<?php 
  function getLinks($loginStatus) {
    $loggedOutLinks = array(
      array(
        "text"=>"What's On",
        "href"=>"filmListings.php",
        "active"=>'false'
      ),
      array(
        "text"=>"Security Report",
        "href"=>"securityReport.php",
        "active"=>'false'
      ),
      array(
        "text"=>"Login",
        "href"=>"loginForm.php",
        "active"=>'false'
      ),
    );
  
    $loggedInLinks = array(
      array(
        "text"=>"What's On",
        "href"=>"filmListings.php",
        "active"=>'false'
      ),
      array(
        "text"=>"Security Report",
        "href"=>"securityReport.php",
        "active"=>'false'
      )    ,
      array(
        "text"=>'Settings',
        "href"=>"accountSettings.php?ref=view-bookings",
        "active"=>'false'
      ),
      array(
        "text"=>"Logout",
        "href"=>"confirmation.php?ref=logout-user",
        "active"=>'false'
      )
    );

    $linksToShow = $loginStatus ? $loggedInLinks : $loggedOutLinks;

    return $linksToShow;
  }

  
  function checkPageType($sessionData, $page) {
    $linkArray = [];
    if(isset($sessionData['logged-in']) && $sessionData['logged-in']) {
      $navigationLinks = getLinks($sessionData['logged-in']);
      $linkArray = populateLinksArray($page, $navigationLinks, $sessionData['name']);
    } else {
      $navigationLinks = getLinks(false);
      $linkArray = populateLinksArray($page, $navigationLinks, null);
    }
    return $linkArray;
  }    
    
    function populateLinksArray($page, $links, $name) {
      $replacementArray = array();
      foreach($links as $l) {
        if($page == $l["href"]) {
          $l["active"] = 'true';
        }
        array_push($replacementArray, $l);
      }  
      return $replacementArray;
    }

    function createAccountSettingsLinks($ref) {
      $accSettingsLinks = array(
        'view-bookings'=>'View Your Bookings',
        'change-password'=>'Change Your Password',
        'delete-account'=>'Delete Your Account',
      );
  
      $output = '';
  
      foreach($accSettingsLinks as $link=>$title) {
        if($link == $ref) {
          $output .= <<<LINK
          <div class="settings-link-container mgb-small">
            <a href="?ref=$link" class="bold adv-link">$title</a>
            <div class="background-highlight-active bg-strong-orange"></div>
          </div>
          LINK;
        } else {
          $output .= <<<LINK
          <div class="settings-link-container mgb-small">
            <a href="?ref=$link" class="bold adv-link">$title</a>
            <div class="background-highlight bg-strong-orange"></div>
          </div>
          LINK;
        }      
      }

      $output .= <<<FINALLINK
      <div class="settings-link-container mgb-small">
        <a href="filmListings.php" class="bold adv-link">Back to Film Listings</a>
        <div class="background-highlight bg-strong-orange"></div>
      </div>
      FINALLINK;
  
      return $output;
    }
    
    ?>