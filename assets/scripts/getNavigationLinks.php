<?php 
  // Function that returns the necessary links given the users login status 
  function getLinks($loginStatus) {
    $loggedOutLinks = array(
      array(
        "text"=>"What's On",
        "href"=>"filmListings.php",
        "active"=>'false'
      ),
      array(
        "text"=>"Design Process",
        "href"=>"designProcess.php",
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
  // function that checks login status and calls the getLinks() function above so that is can generate the navigation
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
    
  // Populate the array that will be returned to buildHeader() in the main page
    function populateLinksArray($page, $links, $name) {
      $replacementArray = array();
      foreach($links as $l) {
        // if the links href is equal to the current page make it active
        if($page == $l["href"]) {
          $l["active"] = 'true';
        }
        array_push($replacementArray, $l);
      }  
      return $replacementArray;
    }

    // This is only for the Account settings page
    function createAccountSettingsLinks($ref) {
      $accSettingsLinks = array(
        'view-bookings'=>'View Your Bookings',
        'change-password'=>'Change Your Password',
        // 'delete-account'=>'Delete Your Account',
      );
  
      $output = '';
      // generate the navigation links for this page
      foreach($accSettingsLinks as $link=>$title) {
        // if the link is === to the refferer make it active else display inactive link
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