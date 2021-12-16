<?php

  function getPath() {
    $path = "/swd-final-assignment/content";
    return $path;
  }

  function confirmationPage($refferer, $db) {
      $path = getPath();
      header("location:$path/confirmation.php?ref=$refferer");
  }

  function inputError($form, $errors) {
    if(gettype($errors) !== 'array') return;
    $path = getPath();
    strpos($form, '?', 0) != 0 ?
          $path = "$path/$form&error=" :
          $path = "$path/$form?error=";
    
    for($i = 0; $i < count($errors); $i++) {
      $path .= $errors[$i];
      if($i != count($errors) -1) {
        $path .= '&error=';
      }
    }

    header("location: $path");
  }

  function statementError($form) {
    $path = getPath();
    header("location: $path/$form?error=unknown");
  }

  function restrictedPage() {
    $path = getPath();
    header("location:$path");
  }
?>