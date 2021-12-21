<?php
  // Return the path for easy code reuse
  function getPath() {
    $path = "/content";
    return $path;
  }
  // Redirect to a confirmation page with the designated referer
  function confirmationPage($refferer) {
      $path = getPath();
      header("location:$path/confirmation.php?ref=$refferer");
  }

  // Redirect to the form to display input errors 
  function inputError($form, $errors) {
    // This stopped errors triggering upon validating the form as this function was being checked even if there were no errors
    if(gettype($errors) !== 'array') return;
    $path = getPath();
    // format the url query
    strpos($form, '?', 0) != 0 ?
          $path = "$path/$form&error=" :
          $path = "$path/$form?error=";
    
    // put each error into the url 
    for($i = 0; $i < count($errors); $i++) {
      $path .= $errors[$i];
      // If you are not at the end of the errors array add a new error query param
      if($i != count($errors) -1) {
        $path .= '&error=';
      }
    }

    // Redirect to the form in question
    header("location: $path");
  }
   
  // If something happens that is unexpected perform this redirect
  function statementError($form) {
    $path = getPath();
    header("location: $path/$form?error=unknown");
  }

  // If someone tries to access a restricted page - redirect to the home page
  function restrictedPage() {
    $path = getPath();
    header("location:$path");
  }
?>