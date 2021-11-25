<?php
  require_once 'databaseActions.php';

  if($_REQUEST) validatForm($_REQUEST);
  function validatForm($request) {
    $inputsArray = [];
    foreach($request as $key=>$value) {
      $inputsArray[$key] = $value;
    }

    $response = insertIntoMovieListings(
                  connectToDatabase(),
                  $inputsArray['movie-name'],
                  $inputsArray['description'],
                  $inputsArray['price'],
                  $inputsArray['rating']
                );

    echo $response;
    echo getTableData('movies', connectToDatabase());
  }
?>