<?php
require_once 'redirects.php';
require_once 'sessionFunctions.php';

function connectToDatabase() {
    $connection = mysqli_connect("localhost", "root", "", "assignment") or
                  die('Database Connection Not Established');
    return $connection;
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

    function checkUserExists($form, $email) {
      $conn = connectToDatabase(); 
      $sql = "SELECT * FROM customers WHERE username = ?";
      if($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, 's', $email);
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
        return mysqli_fetch_assoc($res);
      } else {
        statementError($form);
      }
      
      closeConnection($conn);
    }



    function insertIntoMovieListings($form, $data) {
      $conn = connectToDatabase();
      $sql = "INSERT INTO movies (movie_name, description, ticket_price, rating,      img_path, director, duration) VALUES (?, ?, ?, ?, ?, ?, ?)";
      if($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "ssiisss", $data['movie-name'], $data['description'], $data['price'], $data['rating'], $data['img-path'], $data['director'], $data['duration']);
        return executeStoreGetAffected($stmt);
      } else {
        return false;
      }

      closeConnection($conn);
    }

    function insertNewBooking($data, $userID, $screeningDateTime) {
      $conn = connectToDatabase();
      $sql = "INSERT INTO movie_bookings (movieID, customerID, screening_date_time, num_attending) VALUES (?, ?, ?, ?)" ;
      $stmt = mysqli_prepare($conn, $sql);
      if($stmt) {
        $stmt->bind_param('iiss', $data['movieID'], $userID, $screeningDateTime, $data['number-attending']);
        return executeStoreGetAffected($stmt);
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
        return executeStoreGetAffected($stmt);
      } else {
        return 'Customer Insert Failed';
      }
      closeConnection($conn);
    }

    function getCustomerBookings($id) {
      $conn = connectToDatabase();
      $sql = "SELECT movie_name, screening_date_time, movie_bookings.movieID
              FROM movie_bookings
              INNER JOIN movies ON movie_bookings.movieID = movies.movieID
              WHERE customerID = ?";
      if($stmt = mysqli_prepare($conn, $sql)) {
        $stmt->bind_param('i', $id);
        return getArrayOfResults($stmt);
      }
      closeConnection($conn);
    }

    function updatePassword($newPassword, $customerID) {
      $conn = connectToDatabase();
      $sql = "UPDATE customers SET password_hash = ?
              WHERE customerID = ?";
      if($stmt = mysqli_prepare($conn, $sql)) {
        $stmt->bind_param('si', $newPassword, $customerID);
        return executeStoreGetAffected($stmt);
      } else {
        return 'failed';
      }
    }

    // RESEARCH STORE RESULT;

    function deleteUserFromDatabase($userID) {
      $conn = connectToDatabase();
      $sql = "DELETE customers, movie_bookings FROM customers
              LEFT JOIN movie_bookings ON
              customers.customerID = movie_bookings.customerID
              WHERE movie_bookings.customerID OR customers.customerID  = ?";
      if($stmt = mysqli_prepare($conn, $sql)) {
        $stmt->bind_param('i', $userID);
        return executeStoreGetAffected($stmt);
      }
    }

    function getArrayOfResults($stmt) {
      $stmt->execute();
      $result = $stmt->get_result();
      $resultsArray = [];
      while($row = $result->fetch_assoc()) {
        array_push($resultsArray, $row);
      }
      return $resultsArray;
    }

    function executeStoreGetAffected($stmt) {
      $stmt->execute();
      $stmt->store_result();
      return mysqli_stmt_affected_rows($stmt);
    }

    function closeConnection($conn) {
      $conn->close();
    }

    // IS THIS USED?
    
    // function verifyUsersPassword($pasword, $user) {
    //   $conn = connectToDatabase();
    //   $sql = "SELECT password_hash FROM customers WHERE customerID = ?";
    //   if($stmt = mysqli_prepare($conn, $sql)) {
    //     $stmt->bind_param('s', $user);
    //     return getArrayOfResults($stmt);
    //     $stmt->execute();
    //     $result = $stmt->get_result();
    //     return $result->fetch_assoc();
    //   } else {
    //     return "STATEMENT ERROR";
    //   }

    //   closeConnection($conn);
    // }

?>