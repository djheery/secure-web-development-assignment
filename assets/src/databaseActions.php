<?php
  require_once 'dbconn.php';

  $conn = connectToDatabase();
  getTableData('movies');

  function getTableData($table) {
    $sql = "SELECT  * FROM $table";
    $queryResult = mysqli_query($conn, $sql);
    if($queryResult !== '') {
      while($row = mysqli_fetch_assoc($queryResult)) {
          print_r($row);
          echo "<br><br>";
        }
      }
    };


    function insertIntoMovieListings($conn, $movieName, $desc, $price, $rating) {
      $sql = "INSERT INTO movies (movie_name, description, ticket_price, rating) 
              VALUES (?, ?, ?, ?)";
      if($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "ssii", $movieName, $desc, $price, $rating);
        mysqli_execute($stmt);
        return 'Movie Added <br>';
      } else {
        return 'Error submiting movie';
      }
    }

    function updateTableItem() {

    }

    function deleteTableItem() {

    }


?>