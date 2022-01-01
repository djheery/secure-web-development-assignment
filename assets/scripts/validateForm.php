<?php
  require_once 'preDatabaseInteraction.php';
  require_once 'redirects.php';

  // A list of the know inputs on the website to check against - log errors if the input is not found 
  function getKnownInputs() {
    // Placeholder value in $knownInputs[0] as when first-name was in array[0] the valid input check was always firing
    $knownInputs = array(
      'PLACEHOLDER_VALUE_FOR_CHECK_LINE_52',
      'first-name',
      'last-name',
      'email',
      'confirm-email',
      'old-password',
      'password',
      'confirm-password',
      'movie-name',
      'director',
      'description',
      'rating',
      'movieID',
      'number-attending',
      'booking-time',
      'booking-date',
      'form-path',
      'form-name',
    );

    return $knownInputs;
  }
  
  if($_REQUEST) {
    $formPath = $_REQUEST['form-path'];
    $formName = $_REQUEST['form-name'];
    // Start of form Validation
    list($inputs, $errors) = validationSetup($_REQUEST, $formName);
    // If there are errors
    if(count($errors) > 0) {
      // Go to redirectFilm.php for this function
      inputError($formPath, $errors, $_REQUEST);
    } else {  
      // go to preDatabaseInteraction.php for this function
      $databaseAction = findTargetDatabaseQuery($formName, $inputs);
      // if the result is not true - log errors - if not confirm
      // print_r($databaseAction);
      $databaseAction != 1 ?
        // redirectFilm.php
        inputError($formPath, $databaseAction) :
        // redirects.php
        confirmationPage($formName, $databaseAction);
      }
  } else {
    // If there is no request - redirect to a different page
    header('location: /swd-final-assignment/content/index.php');
  }


  function validationSetup($request, $formName) {
    // Set up arrays to log errors or store validated inputs
    $validated = [];
    $errors = [];
    // so errors are correctly indexed in the errors array
    $errorIndex = 0;
    // Begin the loop through the inputs
    foreach($request as $key=>$value) {
      // If the $request input key is not found return immediatley and display an error 
      if(array_search($key, getKnownInputs()) == false) {
        $errors[$errorIndex] = 'unknown';
        return array($validated, $errors);
      }
      // Check the input - more furtherDown
      $inputCheck = sanitizeValidateUserInput($key, trim($value), $formName);
      // If the input check returns an error
      if(substr($inputCheck, 0, 6) == 'Error:') {
        // If the error is NOT already in the errors add to errors array (This is to prevent the duplication of error messages)
        if(in_array(substr($inputCheck, 7, strlen($inputCheck) - 1), $errors) == false) {
          $errors[$errorIndex] = substr($inputCheck, 7, strlen($inputCheck) - 1);
          $errorIndex++;
        }
      } else {
        // If input passes add to validated array
        $validated[$key] = $inputCheck; 
      }              
    }

    // If confirm password or confirm-email test that the inputs are equal
    if(array_key_exists('confirm-email', $validated) || array_key_exists('confirm-password', $validated)) {
      list($validated, $errors) = confirmInputChecks($validated, $errors, $errorIndex);
    }


    // Return the array
    return array($validated, $errors);   
  }


  function sanitizeValidateUserInput($key, $value, $formName) {
    // If the value is empty return an error to be added to the errors array
    if($value == null || $value == '') return "Error: input-empty";
    // Sanitize every input
    $value = filter_var($value, FILTER_SANITIZE_STRING);
    // Checks for specific inputs more about the functions where they are written
    switch($key) {
      case 'first-name' :
      case 'last-name' :
        $value = strtolower($value);
        return checkNamesAreValid($value);
        break;
      case 'email' :
      case 'confirm-email' :
        $email = strtolower($value);
        return sanitizeValidateEmail($email);
        break;
      case 'booking-date' : 
        return checkBookingDate($value);
        break;
      case 'price' :
        $number =  number_format(sanitizeValidateNumbers($value), 2);
        return $number;
        break;
      case 'password' :
      case 'old-password' :
        $lengthCheckNeeded = checkFormForLengthError($formName);
        return $lengthCheckNeeded == false ?
                  $value : checkPasswordLength($value);
        break;
        case 'movieID' :
          return sanitizeValidateNumbers($value);
        break;
      default :
        return $value;
    }
  }

  // Forms that should not display a length error
  function checkFormForLengthError($currentForm) {
    $formsWithoutLengthCheck = array(
      'login-form',
      'delete-user',
    );

    $checkNeeded = true;
    foreach($formsWithoutLengthCheck as $flc) {
      if($flc == $currentForm) $checkNeeded = false;
    }

    return $checkNeeded;
  }

  // Confirm inputs are equal - Not reusable
  function confirmInputChecks($validated, $errors, $errorIndex) {
    // The below variables check if the array key exiss for confirm password or confirm email if they do then send them to a function that checks their equality - if not the value is null for the purpose of the loop that follows
    $passwords = array_key_exists('confirm-password', $validated) ?
    checkInputsAreEqual('password',$validated['password'], $validated['confirm-password']) : 
    array('password'=>true);
    $emails = array_key_exists('confirm-email', $validated) ?
      checkInputsAreEqual('email', $validated['email'], $validated['confirm-email']) : 
      array('email'=>true);
      // put the above values into an array 
      $inputEqualityCheck = array($passwords, $emails);
      for($i = 0; $i < count($inputEqualityCheck); $i++) {
        foreach($inputEqualityCheck[$i] as $key=>$value) {
          // If the value is not true push the error and the statement to the errors array 
          if($value != 1) {
            $errors[$errorIndex] = $value;
            $errorIndex++;
          }
      }
    }
    return array($validated, $errors);
  } 

  // Check that the booking date is inside the given range
  function checkBookingDate($date) {
    if(strtotime($date) > strtotime(date('y-m-d') . ' +14 days') || strtotime($date) < strtotime(date('y-m-d'))) {
      $date = 'Error: invalid-date'; 
    }
    
    return $date;
  }

  // Check if there is a space within peoples name or a name is too long
  function checkNamesAreValid($name) {
    if(strpos($name, ' ') != 0) {
      return 'Error: whitespace-in-name';
    } elseif(strlen($name) > 24) {
      return 'Error: name-length';
    } else {
      return $name;
    }
  }

  // Sanitize and validate emails
  function sanitizeValidateEmail($email) {
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    if($email = filter_var($email, FILTER_VALIDATE_EMAIL)) {
      return $email;
    } else {
      return 'Error: email-invalid';
    }
  }

  // Check inputs are equal
  function checkInputsAreEqual($key, $input1, $input2) {
    // This is not reusable and only works for this usecase
    $equalityCheck = $input1 === $input2 ?
                      array($key=>true) :
                      array($key == 'password' ? 
                        'password-match' : 
                        'email-match');
    return $equalityCheck;
  }

  // Check the password Length is greater than 8
  function checkPasswordLength($password) {
    $lengthCheck = strlen($password) < 8 ?
                   'Error: password-length' : $password;
    return $lengthCheck;
  }

  // validate any numbers passed in 
  function sanitizeValidateNumbers($number) {
    $validatedNumber = filter_var($number, FILTER_VALIDATE_INT);
    
    return $validatedNumber ? $validatedNumber : 'Error: unknown';
  }

  function checkBookingTime($time) {
    $allowedTimes = array('14:00', '16:00', '18:00', '20:00', '22:00');

    // Check array to see If its an allowed time.

  }

  function checkAttending() {
    $attending = array('1', '2', '3', '4', '5', '6');

    // Check to see if its an allowed amount of 
  }

  function passwordContainsNameCheck() {

  }

  function ratingCheck() {
    $allowedMovieRatings = ('PG', '12', '15'. '18');

    // Check to see allowed amount
  }

  function checkInputParameterIsAllowed($allowedParams, $input) {
    $result = array_key_exists($input, $allowedParams) ? $input : 'Error: user-error';
    return $result;
  }

  https://identity.northumbria.ac.uk/connect/authorize/callback?client_id=Sitecore&response_mode=form_post&response_type=code%20id_token%20token&scope=openid%20sitecore.profile&state=OpenIdConnect.AuthenticationProperties%3DBu7u_0YjNqtkaNn75lmDq4nKOawET66REHDl9_p5rx8Dp7_pqmr_CZ7OgzRfLaXWJHGZpsilG3aNlOSkHnVjeOxMUzBy1r6LsyeXf22T6ihikseJwmeo5UAWDEAgvM0LuAxdy5Ym9uEFS4l5mc3wOiQtMZGaFBn6XLLdvB1WHZMcF-bzN-946Kn6rUXSS-p_puOQ_EPOPYV6cCXvA6K5ZfHxkvbCi2hZIrkOOEQCPebBrB78w9LFWwbe0U2AJKn78RjZSJG1yzMKhPzSwFQTXA&nonce=637766609474897211.ZmMxNjAzNmQtNmEwOC00Yjc3LWFhYmUtYWFhZDI3YzJlMjJhZGJiNGE2ZmQtYzU0My00NjU3LWJiNzctY2E3Y2Q3M2I2MWE1&acr_values=idp%3AIdS4-WsFederation&redirect_uri=https%3A%2F%2Fmyportal.northumbria.ac.uk%2Fidentity%2Fsignin&sc_account_prefix=azure%5C&x-client-SKU=ID_NET451&x-client-ver=5.2.2.0
  https://sts.northumbria.ac.uk/adfs/ls/?wtrealm=urn%3Asitecoreidentity&wa=wsignin1.0&wreply=https%3A%2F%2Fidentity.northumbria.ac.uk%2Fsignin-wsfed&wctx=CfDJ8HGSH1bc4cFAsVSrBVKkZUF5fmc2phxz4vT3Uyk_9_T_EvE2Lqyd7Gzre_5nuidNhvDeNu4Bahti701BWUkIy0JxaU70D8dgBsvGQPOY8653kjLH7gtLp9Hzemu6jwM99KoxZu0uov5PpU2hzj18IUhrUlUidVxCOoJKkRzgvAoFJcF-tnfT3DDkkktTeJIInWnmnm40zzsdctUyLu4c62uRQkON8MB1eRENxM-xYbJUIbbcX3CRtDlAjs8xACpQg3FQ5ha4yBBN3i5LBWVtJd_l-B14G3yWqNATMRUvw23aUUtomLC6TTj7Av_kU7U3c-dOg72KX3dEQzLiF8wpwsykRX789e3NDs9eaX1tVPYRuBNW1Gc_yy3ycKQ6evpO7WxIonO5QkdZRfsR1QkAezWmsJYFFqvdSzCwzqYBEEYOVYsu-YLGPTvpiquDm8vch4L_0OAPmFP9MmEipigD6XjZuWrU2JT_hDxa0HQNlnHlfl94CeqRE-PBzymJHf8w0gjOmWs8XpiuyRHa9m4vF9k_gcX1ahTqxlSq-iAPshNCNGqeEM_58nkH0LAr0eCBDztfKv5wWYzlBn8NNaDf70pUjPixm-SNrxrSq-EGnIfUWHNLVaagW89aQvVt4yTtVz-HMGgPT_f_FfIBE_mhD09xzKWZnEMv1Oi3UzALn0sdT3_TTH6zUVV8qDD4dKSX0spnG-V5ksX_slRKQR7ftkkCJVR2Ov6ZDgUOJ10yV3cbDmdVCJhpoxGJO4nfiH_N2c6cuughQDocy08NQk1vCBJRFb6T0rzfJdBOpU0E-pXzO2VhaHYD5MA-uDYMY1PbJvjtzCZnJlq_YbrdiAeUg0_XjXxAvsAjEheFQXJacGEAlIiT_nAfAJkUh5hG0Y9Ch_3oyf3eQHiRi1B7kgrzh-XIVqTmhqsL3ylUY6nQ-GinDHYSyYfJzuwpfKe9-lWiVhmRGg_SH4svGiyH9TnrHArzrmZmudkdf5DJKFe74sfv0yBWL1HVm0SDBLngiSXQMKPx1JQutZuVqLeq7dZyb3ZPsGPcec44DnPg2Kf1xIUg3JVvJJdfmFJEtWiusjZtQMKHPPbMU2BJIOs79LWKp-PBt9c0UMq9wC1Ben7XJLmciRivNMVsUoX98p4aAbbEeCWQO6pofebK1fWH0CM-mlaW6X1m1Oxy7XUmKSAYIOoODXE9WHbADtR1t2VWqtMBOL3-Gq77A42r8ixw_vntRvEhGm3XFu_FAauIUX-se7KMIlwoWezsLskSsLsXMVLuD8Pru4pGn3hu89VKZhlD-7dkhGqrn5UCLCUQuZZocklO
?>