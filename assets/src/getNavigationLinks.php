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
        "text"=>'Hi',
        "href"=>"accountSettings.php",
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
      if($l['href'] == 'accountSettings.php') $l['text'] .= ", $name";
      if($page == $l["href"]) {
        $l["active"] = 'true';
      }
      array_push($replacementArray, $l);
    }  
    return $replacementArray;
  }

?>