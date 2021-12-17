<?php
  require_once 'databaseActions.php';
  require_once 'sessionFunctions.php';
  require_once 'redirects.php';

  function findTargetDatabaseQuery($form, $data) {
    switch ($form) {
      case 'sign-up' :
        unset($data['confirm-email']);
        unset($data['confirm-password']);
        return signUpForm($form, $data);
        break;
      case 'login' :
        return loginForm($form, $data);                            
        break;
      case 'delete-user' :
        return deleteUserPrePostActions($form, $data);
        break;
      case 'change-password' :
        return changePassword($form, $data);
        break;
      case 'booking-form' :
        return bookingForm($form, $data);
        break;
      case 'add-movie':
        $insert = insertIntoMovieListings($form, $data);
        return $insert == 1 ? true : array('movie-insert-error'); 
        break;
      case 'individual-listing-page' :
      case 'booking-page' :
        return validatePageId($data);
        break;
      default :
        header('location: index.php');
        break;
    }
  }

  function signUpForm($form, $data) {
    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT); 
    $userCheck = checkUserExists($form, $data['email']) ?  
              array('user-exists') : 
              insertNewCustomer($data);
    if($userCheck == 1) setSessionData($data['first-name'], $data['email'], array());
    return $userCheck;
  }

  function loginForm($form, $data) {
    $userCheck = checkUserExists($form, $data['email']);
    if($userCheck) {
      $validatePassword = password_verify($data['password'], $userCheck['password_hash']);
      // Password Correct ? Set Session Data : Do Nothing
      $validatePassword ? 
          setSessionData($userCheck['customer_forename'], $userCheck['username'], getCustomerBookings($userCheck['customerID'])) :
          null;
      // Password Correct ? Return 1 : Return Error to be displayed
      return $validatePassword ? $validatePassword : array('user-error');
    } else {
      return array('user-error');
    }                           
  }

  function bookingForm($form, $data) {
    // Check user exists using session Data
    $userCheck = getSessionDataForUserCheck($form);
    // Use the session data to attach the email to the user check
    $data['email'] = $sessionData['username'];
    $screeningDateTime = "{$data['booking-date']} {$data['booking-time']}";
    if($userCheck) {
      $insertBooking = insertNewBooking($data, $userCheck['customerID'], $screeningDateTime);
      // Booking Inserted to customer ? Add the Booking to the session data : Do nothing 
      $insertBooking == 1 ? addBookingToSession(array(
                            "movieID"=>$data['movieID'],
                            "screening_date_time"=>$screeningDateTime, 
                            "movie_name"=>$data['movie-name'])) :
                            null;
      // Regenerate Session ID 
      preventSessionFixation();
      // Booking Inserted to customer ? return 1 : return booking-exists error (This function will only insert 1 row to the database or none)
      return $insertBooking == 1 ? $insertBooking : array('booking-exists');
    } else {
       // If the user is not found Destroy the session redirect to login page
      userCheckFailureWhilstLoggedIn();
    } 
  }

  function changePassword($form, $data) {
    // Use Session Data to check the user;
    $userCheck = getSessionDataForUserCheck($form);
    if($userCheck) {
      // Verify old Password
      $verifyOldPassword = password_verify($data['old-password'], $userCheck['password_hash']); 
      // Verify that the new password is not the same as the old password
      $verifyNewPassword = password_verify($data['password'], $userCheck['password_hash']);
      // If it is not then update the password for a specific user
      if($verifyOldPassword && $verifyNewPassword != 1) {
        preventSessionFixation();
        $passwordHash = password_hash($data['password'], PASSWORD_DEFAULT);
        return updatePassword($passwordHash, $userCheck['customerID']);
      } else {
        return array('password-change-fail');
      }
    } else {
      // If the user is not found Destroy the session redirect to login page
      userCheckFailureWhilstLoggedIn();
    }
  }

  function deleteUserPrePostActions($form, $data) {
    // Double Check the user exists
    $userCheck = getSessionDataForUserCheck($form);
    if($userCheck) {
      $verifyPassword = password_verify($data['password'], $userCheck['password_hash']);
      if($verifyPassword) {
        $delete = deleteUserFromDatabase($userCheck['customerID']);
        preventSessionFixation();
        return $delete <= 0 ? array('account-delete-failed') : true;
      } else {
        return array('password-match');
      }
    } else {
      // If the user is not found Destroy the session and redirect to login page;
      userCheckFailureWhilstLoggedIn();
    }
  }

  function getSessionDataForUserCheck($form) {
    generateSession();
    $sessionData = getSessionData();
    $userCheck = checkUserExists($form, $sessionData['username']);
    return $userCheck;
  }

  function userCheckFailureWhilstLoggedIn() {
    unsetDestroySession();
    inputError('loginForm.php', 'user-error');
  }

  function validatePageId($queryID) {
    $queryID = filter_var($queryID, FILTER_SANITIZE_STRING);
    $queryID = filter_var($queryID, FILTER_VALIDATE_INT);
    if($queryID) {
      return getIndividualMovie($queryID);
    } else {
      return false;
    }
  }

  

?>
