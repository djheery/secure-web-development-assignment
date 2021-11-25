<?php 
  function getLinks() {
    $baseLinks = array(
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
        "text"=>"Login",
        "href"=>"login.php",
        "active"=>'false'
      ),
    );
  
    $loggedInLinks = array(
      array(
        "text"=>'Hi',
        "href"=>"accountSettings.php",
        "active"=>'false'
      ),
      array(
        "text"=>"Logout",
        "href"=>"index.php",
        "active"=>'false'
      )
    );

    return $baseLinks;
  }

  
  function checkPageType($loginStatus, $page) {
    $baseLinks = getLinks();
    $linkArray = [];
    if($loginStatus === "Logged In") {
      $linkArray = loggedInLinks();
    }
    if($loginStatus === "Logged Out"){
      $linkArray = loggedOutLinks($page, $baseLinks);
    } 
    return $linkArray;
  }

  function loggedInLinks() {

  }

  function loggedOutLinks($page, $links) {
    $replacementArray = array(); // THIS NEEDS TO CHANGE FIND OUT HOW TO MANIPULATE A GIVEN ARRAY, is it something to do with memory storage?
    foreach($links as $l) {
      if($page == $l["href"]) {
        $l["active"] = 'true';
      }
      array_push($replacementArray, $l);
    }  
    return $replacementArray;
  }

?>