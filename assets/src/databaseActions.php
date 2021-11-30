<?php
  require_once 'dbconn.php';

  function findTargetDatabase($form, $data) {
    switch ($form) {
      case 'signUpForm.php' :
        return insertNewCustomer($data);
        break;
      case 'loginForm.php' :
        break;
      case 'deletUser' :
        break;
      case 'changePassword' :
        break;
      case 'bookingsPage.php' :
        break;
      default :
        break;
    }
  }
  
  function getTableData($table) {
    $conn = connectToDatabase();
    $sql = "SELECT  * FROM $table";
    $queryResult = mysqli_query($conn, $sql);
    if($queryResult !== '') {
      $movieObj = [];
      while ($row = mysqli_fetch_assoc($queryResult)) {
        array_push($movieObj, $row);
      } 
      return $movieObj;
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

    function insertNewCustomer($data) {
      $conn = connectToDatabase();
      $sql = "INSERT INTO customers (password_hash, username, customer_forename, customer_surname) VALUES (?, ?, ?, ?)";
      if($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "ssss", $data['password'], $data['email'], $data['first-name'], $data['last-name']);
        mysqli_execute($stmt);
        return "SUCCESS";
      } else {
        return 'FAIL';
      }
    }

    function updateTableItem() {

    }

    function deleteTableItem() {

    }

    function getIndividualFilm($id) {
      $conn = connectToDatabase();
      $sql = "SELECT * FROM movies
              WHERE movieID = $id";
      $queryResult = mysqli_query($conn, $sql);
      if($queryResult !== '') {
        $movieObj = [];
        while($row = mysqli_fetch_assoc($queryResult)) {
          array_push($movieObj, $row);
        }
        return $movieObj;
      }
    }


?>