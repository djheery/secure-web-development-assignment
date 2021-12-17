<?php
  function generateSession() {
    ini_set("session.save_path", "C:/xampp/htdocs/swd-final-assignment/assets/session-data");
    session_start(); 
  }

  function getSessionData() {
    if(isset($_SESSION['logged-in']) && $_SESSION['logged-in']) {
      return $_SESSION;
    } else {
      return false;
    }
  }

  function preventSessionFixation() {
    session_regenerate_id(true);
  }

  function setSessionData($name, $email, $bookings) {
    generateSession();
    $_SESSION['logged-in'] = 1;
    $_SESSION['name'] = ucfirst($name);
    $_SESSION['username'] = $email;
    $_SESSION['bookings'] = $bookings;
  };

  function addBookingToSession($booking) {
    array_push($_SESSION['bookings'], $booking);
  }

  function unsetDestroySession() {
    unset($_SESSION);
    session_destroy();
  };
?>