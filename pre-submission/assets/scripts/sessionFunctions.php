<?php
  //Generate session data and dictate save path 
  function generateSession() {
    ini_set("session.save_path", "C:/xampp/htdocs/swd-final-assignment/assets/session-data");
    session_start(); 
  }

  // return session data if logged in
  function getSessionData() {
    if(isset($_SESSION['logged-in']) && $_SESSION['logged-in']) {
      return $_SESSION;
    } else {
      return false;
    }
  }

  // Regenerate session id after a database interaction
  function preventSessionFixation() {
    session_regenerate_id(true);
  }

  // Set Session Data
  function setSessionData($name, $email, $bookings) {
    generateSession();
    $_SESSION['logged-in'] = 1;
    $_SESSION['name'] = ucfirst($name);
    $_SESSION['username'] = $email;
    $_SESSION['bookings'] = $bookings;
  };

  // Add Booking to session
  function addBookingToSession($booking) {
    array_push($_SESSION['bookings'], $booking);
  }

  // Unset and destroy a session
  function unsetDestroySession() {
    unset($_SESSION);
    session_destroy();
  };
?>