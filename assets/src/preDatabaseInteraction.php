<?php
  require_once 'databaseActions.php';
  require_once 'sessionFunctions.php';

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
        break;

      default :
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
      if($validatePassword) {
        setSessionData($userCheck['customer_forename'], 
                       $userCheck['username'], 
                       getCustomerBookings($userCheck['customerID']));
        print_r(getCustomerBookings($userCheck['customerID']));
        return $validatePassword;
      } else {
        return array('user-error');
      }
    } else {
      return array('user-error');
    }                           
  }

  function bookingForm($form, $data) {
    generateSession();
    $sessionData = getSessionData();
    $data['email'] = $sessionData['username'];
    $screeningDateTime = "{$data['booking-date']} {$data['booking-time']}";
    $userCheck = checkUserExists($form, $data['email']);
    print_r($userCheck);
    if($userCheck){
      $result = insertNewBooking($data, $userCheck['customerID'], $screeningDateTime);
      if($result == 1) {
        addBookingToSession(array(
          "movieID"=>$data['movieID'],
          "screening_date_time"=>$screeningDateTime, 
          "movie_name"=>$data['movie-name']));
        return $result;
      } else {
        return array('booking-exists');
      }
    } else {
      return array('unknown');
    } 
  }

  function changePassword($form, $data) {
    generateSession();
    $sessionData = getSessionData();
    $userCheck = checkUserExists($form, $sessionData['username']);
    if($userCheck) {
      // Verify old Password
      $verifyOldPassword = password_verify($data['old-password'], $userCheck['password_hash']);     
      // Verify that the new password is not the same as the old password
      $verifyNewPassword = password_verify($data['password'], $userCheck['password_hash']);
      // If it is not then update the password for a specific user
      if($verifyOldPassword && $verifyNewPassword != 1) {
        $passwordHash = password_hash($data['password'], PASSWORD_DEFAULT);
        return updatePassword($passwordHash, $userCheck['customerID']);
      }
    }
  }

  function deleteUserPrePostActions($form, $data) {
    generateSession();
    $sessionData = getSessionData();
    $userCheck = checkUserExists($form, $sessionData['username']);
    if($userCheck) {
      $verifyPassword = password_verify($data['password'], $userCheck['password_hash']);
      if($verifyPassword) {
        $delete = deleteUserFromDatabase($userCheck['customerID']);
        return $delete <= 0 ? array('account-delete-failed') : true;
      } else {
        return array('password-match');
      }
    }
  }

?>
