<?php
  require_once 'databaseActions.php';
  require_once 'errorHandling.php'
  
  if($_REQUEST) {
    list($inputs, $errors) = validationSetup($_REQUEST);
    if(count($errors) > 0) {
      findTargetErrorHandler($inputs['hidden'], $errors);
    } else {
      findTargetDatabaseQuery($inputs['hidden'], $inputs);
    }
  } 

  function validationSetup($request) {
    $fieldsValidated = [];
    $errors = [];
    foreach($request as $key=>$value) {
      $inputCheck = sanitizeValidateUserInput($key, $value);
      substr($inputCheck, 0, 6) == 'Error:' ?
        $errors[$key] = $inputCheck :
        $fieldsValidated[$key] = $inputCheck; 
    }

    
    if(count($errors) > 0) return array($fieldsValidated, $errors);
    
    if($fieldsValidated['confirm-email']) {
      $equalityCheck = checkInputsAreEqual($fieldsValidated['email'], $fieldsValidated['confirm-email']);
      unset($fieldsValidated['confirm-email']);
      if($equalityCheck != 'EQUAL') {
        $errors['email'] = 'Error: Emails do not match';
      }  
    }
    
    if($fieldsValidated['confirm-password']) {
      $confirmPasswordCheck = confirmPasswordCheck($fieldsValidated['confirm-password'], $fieldsValidated['password']);
      unset($fieldsValidated['confirm-password']);
      if($confirmPasswordCheck != 'EQUAL') {
        $errors['password'] = 'Error: Passwords do not match';
      } 
    }
    
    return array($fieldsValidated, $errors);
    

  }

  function runTests($errors, $inputs) {
    foreach($inputs as $key=>$value) {
      echo "$key==>>$value<br>";
    }
    foreach($errors as $key=>$value) {
      echo "$key==>>$value<br>";
    }
  }

  function sanitizeValidateUserInput($key, $value) {
    if($value == null) return "Error: You must fill out input: $key";
    switch($key) {
      case 'first-name' :
      case 'last-name' :
        return sanitizeValidateString($value);
        break;
      case 'email' :
      case 'confirm-email' :
        $email = strtolower($value);
        return sanitizeValidateEmail($email);
        break;
      case 'password' :
        $pswd = sanitizeValidateString($value);
        return password_hash($pswd, PASSWORD_DEFAULT);
        break;
      case 'confirm-password' :
        return sanitizeValidateString($value);
        break;
      case 'hidden' : 
        return $value;
      default :
        'Error: User Input is not Defined';
    }
  }

  function sanitizeValidateString($str) {
    $str = filter_var($str, FILTER_SANITIZE_STRING);
    return $str;
  }

  function sanitizeValidateEmail($email) {
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    if($email = filter_var($email, FILTER_VALIDATE_EMAIL)) {
      return $email;
    } else {
      return 'Error: Email is not Valid';
    }
  }

  function confirmPasswordCheck($confirm, $pwd) {
    $verifyEquality = password_verify($confirm, $pwd) ?
              'EQUAL' : 
              'NOT EQUAL';
    return $verifyEquality;
  }

  function checkInputsAreEqual($input1, $input2) {
    $equalityCheck = $input1 === $input2 ?
                      'EQUAL' :
                      'Error: Your inputs do not Match';

    return $equalityCheck;
  }
?>