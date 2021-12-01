<?php
  require_once 'dbconn.php';

  function findTargetDatabaseQuery($form, $data) {
    switch ($form) {
      case 'signUpForm.php' :
        $userCheck = checkUserExists($form, $data);
        return $userCheck ? 'USER EXISTS' : insertNewCustomer($userCheck); 
        break;
      case 'loginForm.php' :
        $userCheck = checkUserExists($form, $data);
        break;
      case 'deleteUser' :
        break;
      case 'changePassword' :
        break;
      case 'bookingsPage.php' :
        break;
      case 'addMovies.php';
      default :
        break;
    }
  }

  // Add Prepared Statements
  
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

    function checkUserExists($form, $data) {
      $conn = connectToDatabase();
      $sql = "SELECT * FROM customers WHERE username = ?";
      if($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, 's', $data['email']);
        mysqli_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result);
      } else {
        return 'STATEMENT ERROR';
      }
    }


    function insertIntoMovieListings($movieName, $desc, $price, $rating) {
      $conn = connectToDatabase();
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
        return "Customer {$data['first-name']} {$data['last-name']} inserted into the Database";
      } else {
        return 'Customer Insert Failed';
      }
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

    function getCustomerBookings() {

    }

    function updateCustomerDetails() {

    }

    function deleteTableItem() {

    }

    function addBookingToCustomer() {
      
    }
?>