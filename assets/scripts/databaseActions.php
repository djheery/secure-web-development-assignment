<?php
require_once 'redirects.php';
require_once 'sessionFunctions.php';
require_once 'dbconn.php';

  
  // Responsible for getting all movie data for the film listing page
  function getMovieData() {
    $conn = connectToDatabase();
    $sql = "SELECT  * FROM movies";
    if($stmt = mysqli_prepare($conn, $sql)) {
      // Reusable function at the bottom of the page
      return getArrayOfResults($stmt);
    } else {
      return false;
    } 
      closeConnection($conn);
    };

    // Check a user exists
    function checkUserExists($form, $email) {
      $conn = connectToDatabase(); 
      $sql = "SELECT * FROM customers WHERE username = ?";
      if($stmt = mysqli_prepare($conn, $sql)) {
         // Reusable function at the bottom of the page
        mysqli_stmt_bind_param($stmt, 's', $email);
        return getArrayOfResults($stmt);
      } else {
        return false;
      }

      closeConnection($conn);
    }

    // Get individual movie for BookingForm.php and individualFilmListing.php
    function getIndividualMovie($movieID) {
      $conn = connectToDatabase();
      $sql = "SELECT * FROM movies WHERE movieID = ?";
      if($stmt = mysqli_prepare($conn, $sql)) {
        $stmt->bind_param('i', $movieID);
         // Reusable function at the bottom of the page
        return getArrayOfResults($stmt);
      } else {
        return false;
      }
      
      closeConnection($conn);
    }


    // Adding a movie from the add movie form
    function insertIntoMovieListings($form, $data) {
      $conn = connectToDatabase();
      $sql = "INSERT INTO movies (movie_name, description, ticket_price, rating,      img_path, director, duration) VALUES (?, ?, ?, ?, ?, ?, ?)";
      if($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "ssiisss", $data['movie-name'], $data['description'], $data['price'], $data['rating'], $data['img-path'], $data['director'], $data['duration']);
         // Reusable function at the bottom of the page
        return executeStoreGetAffected($stmt);
      } else {
        return false;
      }

      closeConnection($conn);
    }
    // Add a new booking for the movie booking form
    function insertNewBooking($data, $userID, $screeningDateTime) {
      $conn = connectToDatabase();
      $sql = "INSERT INTO movie_bookings (movieID, customerID, screening_date_time, num_attending) VALUES (?, ?, ?, ?)" ;
      $stmt = mysqli_prepare($conn, $sql);
      if($stmt) {
        $stmt->bind_param('iiss', $data['movieID'], $userID, $screeningDateTime, $data['number-attending']);
         // Reusable function at the bottom of the page
        return executeStoreGetAffected($stmt);
      } else {
        return false;
      }

      closeConnection($conn);
    }

    // Insert Customer
    function insertNewCustomer($data) {
      $conn = connectToDatabase();
      $sql = "INSERT INTO customers (password_hash, username, customer_forename, customer_surname) VALUES (?, ?, ?, ?)";
      if($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "ssss", $data['password'], $data['email'], $data['first-name'], $data['last-name']);
         // Reusable function at the bottom of the page
        return executeStoreGetAffected($stmt);
      } else {
        return false;
      }
      closeConnection($conn);
    }
    // retrive the customer bookings
    function getCustomerBookings($id) {
      $conn = connectToDatabase();
      $sql = "SELECT movie_name, screening_date_time, movie_bookings.movieID
              FROM movie_bookings
              INNER JOIN movies ON movie_bookings.movieID = movies.movieID
              WHERE customerID = ?";
      if($stmt = mysqli_prepare($conn, $sql)) {
        $stmt->bind_param('i', $id);
         // Reusable function at the bottom of the page
        return getArrayOfResults($stmt);
      } else {
        return false;
      }
      closeConnection($conn);
    }

    // Update the password
    function updatePassword($newPassword, $customerID) {
      $conn = connectToDatabase();
      $sql = "UPDATE customers SET password_hash = ?
              WHERE customerID = ?";
      if($stmt = mysqli_prepare($conn, $sql)) {
        $stmt->bind_param('si', $newPassword, $customerID);
       // Reusable function at the bottom of the page
        return executeStoreGetAffected($stmt);
      } else {
        return false;
      }
    }

    // Delete user from database and all of their bookings
    function deleteUserFromDatabase($userID) {
      $conn = connectToDatabase();
      $sql = "DELETE customers, movie_bookings FROM customers
              LEFT JOIN movie_bookings ON
              customers.customerID = movie_bookings.customerID
              WHERE movie_bookings.customerID OR customers.customerID  = ?";
      if($stmt = mysqli_prepare($conn, $sql)) {
        $stmt->bind_param('i', $userID);
         // Reusable function at the bottom of the page
        return executeStoreGetAffected($stmt);
      } else {
        return false;
      }
    }

    
  function checkMovieExists($movieID) {
    $conn = connectToDatabase();
    $sql = "SELECT * FROM movies WHERE movieID = ?";
    if($stmt = mysqli_prepare($conn, $sql)) {
      $stmt->bind_param('i', $movieID);
      return getArrayOfResults($stmt);
    } else {
      return false;
    }
  }

    // Reusable function to fetch_assoc()
    function getArrayOfResults($stmt) {
      $stmt->execute();      
      $result = $stmt->get_result();
      $resultsArray = [];
      $numRows = mysqli_num_rows($result);
      if($numRows) {
        // If there are multiple rows loop until all items are in results array
        if($numRows > 1) {
          while($row = mysqli_fetch_assoc($result)) {
            array_push($resultsArray, $row);
          } 
        } else {
          // If there is only one return one array
         $resultsArray = mysqli_fetch_assoc($result); 
        }
      }
      return $resultsArray;
    }
    // execute function and get the affected rows
    function executeStoreGetAffected($stmt) {
      $stmt->execute();
      $stmt->store_result();
      return mysqli_stmt_affected_rows($stmt);
    }
    // close the database connection
    function closeConnection($conn) {
      $conn->close();
    }
?>