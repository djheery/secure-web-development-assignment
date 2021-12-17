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
  
  function getMovieData() {
    $conn = connectToDatabase();
    $sql = "SELECT  * FROM movies";
    if($stmt = mysqli_prepare($conn, $sql)) {
      return getArrayOfResults($stmt);
    } else {
      return false;
    } 
      closeConnection($conn);
    };

    function checkUserExists($form, $email) {
      $conn = connectToDatabase(); 
      $sql = "SELECT * FROM customers WHERE username = ?";
      if($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, 's', $email);
        return getArrayOfResults($stmt);
      } else {
        return false;
      }

      closeConnection($conn);
    }

    function getIndividualMovie($movieID) {
      $conn = connectToDatabase();
      $sql = "SELECT * FROM movies WHERE movieID = ?";
      if($stmt = mysqli_prepare($conn, $sql)) {
        $stmt->bind_param('i', $movieID);
        return getArrayOfResults($stmt);
      } else {
        return false;
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
        return false;
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
        return false;
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
      } else {
        return false;
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
        return false;
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
      } else {
        return false;
      }
    }

    function getArrayOfResults($stmt) {
      $stmt->execute();      
      $result = $stmt->get_result();
      $resultsArray = [];
      $numRows = mysqli_num_rows($result);
      if($numRows) {
        if($numRows > 1) {
          while($row = mysqli_fetch_assoc($result)) {
            array_push($resultsArray, $row);
          } 
        } else {
         $resultsArray = mysqli_fetch_assoc($result); 
        }
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
?>