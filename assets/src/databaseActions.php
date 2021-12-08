<?php
require_once 'redirects.php';
require_once 'sessionFunctions.php';

function connectToDatabase() {
    $connection = mysqli_connect("localhost", "root", "", "assignment") or
                  die('Database Connection Not Established');
    return $connection;
  }

  function findTargetDatabaseQuery($form, $data) {
    // if($form !== 'signUpForm.php' && $_SESSION['logged-in'] !== 1) restrictedPage();
    switch ($form) {
      case 'signUpForm.php' :
        unset($data['confirm-email']);
        unset($data['confirm-password']);
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT); 
        $userCheck = checkUserExists($form, $data) ?  
                  array('user-exists') : 
                  insertNewCustomer($data);
        if($userCheck == 1) setSessionData($data['first-name'], $data['email'], null);
        return $userCheck;
        break;
      case 'loginForm.php' :
        $userCheck = checkUserExists($form, $data);
        return $userCheck ? 
                  password_verify($data['password'], $userCheck['password_hash']) : 
                  array('user-error');
        break;
      case 'deleteUser' :
        break;
      case 'changePassword' :
        break;
      case 'bookingForm.php' :
        $data['email'] = 'heery@live.co.uk';
        $screeningDateTime = "{$data['booking-date']} {$data['booking-time']}";
        $userCheck = checkUserExists($form, $data);
        return $userCheck ? 
                  insertNewBooking($data, $userCheck['customerID'], $screeningDateTime) :
                  array('unknown');
        break;

      case 'addMovies.php':
        break;

      default :
        break;
    }
  }

  // Add Prepared Statements
  // Add Reusable Statement Failure Function
  // Potentially Add Reusable mysqli_execute, get_results, bind_param, etc
  
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

      closeConnection($conn);
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
        statementError($form);
      }

      closeConnection($conn);
    }

    function getIndividualMovie($movieID) {
      $conn = connectToDatabase();
      $sql = "SELECT * FROM movies WHERE movieID = ?";
      if($stmt = mysqli_prepare($conn, $sql)) {
        $stmt->bind_param('i', $movieID);
        $stmt->execute();
        $res = $stmt->get_result();
        return $res->fetch_assoc();
      } else {
        statementError($form);
      }
      
      closeConnection($conn);
    }


    function insertIntoMovieListings($movieName, $desc, $price, $rating) {
      $conn = connectToDatabase();
      $sql = "INSERT INTO movies (movie_name, description, ticket_price, rating) 
              VALUES (?, ?, ?, ?)";
      if($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "ssii", $movieName, $desc, $price, $rating);
        mysqli_execute($stmt);
        return true;
      } else {
        return 'Error submiting movie';
      }

      closeConnection($conn);
    }

    // Error - Will not let me book 2 of the same movie for the same customer

    function insertNewBooking($data, $userID, $screeningDateTime) {
      $conn = connectToDatabase();
      $sql = "INSERT INTO movie_bookings (movieID, customerID, screening_date_time, num_attending) VALUES (?, ?, ?, ?)" ;
      $stmt = mysqli_prepare($conn, $sql);
      if($stmt) {
        $stmt->bind_param('iiss', $data['movieID'], $userID, $screeningDateTime, $data['number-attending']);
        $stmt->execute();
        $result = $stmt->get_result();
        return true;
      } else {
        return 'STATEMENT-ERROR';
      }

      closeConnection($conn);
    }

    function insertNewCustomer($data) {
      $conn = connectToDatabase();
      $sql = "INSERT INTO customers (password_hash, username, customer_forename, customer_surname) VALUES (?, ?, ?, ?)";
      if($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "ssss", $data['password'], $data['email'], $data['first-name'], $data['last-name']);
        mysqli_execute($stmt);
        return true;
      } else {
        return 'Customer Insert Failed';
      }
      closeConnection($conn);
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
      closeConnection($conn);
    }

    function verifyUsersPassword($pasword, $user) {
      $conn = connectToDatabase();
      $sql = "SELECT password_hash FROM customers WHERE customerID = ?";
      if($stmt = mysqli_prepare($conn, $sql)) {
        $stmt->bind_param('s', $user);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
      } else {
        return "STATEMENT ERROR";
      }

      closeConnection($conn);
    }

    function getCustomerBookings() {

    }

    function updateCustomerDetails() {

    }

    function deleteTableItem() {

    }

    function addBookingToCustomer() {
      // Git to git
    }

    function closeConnection($conn) {
      $conn->close();
    }
?>