<?php
  require_once "../assets/src/buildPage.php";
  $filePaths = filePaths();
  require_once "{$filePaths['scripts']}/getNavigationLinks.php";
  require_once "{$filePaths['scripts']}/sessionFunctions.php";
  // Session Information
  generateSession();
  $sessionData = getSessionData();
  // Page name for title
  $pageName = getPageName($_SERVER['PHP_SELF']);
  // Navigation 
  $navigationLinks = checkPageType($sessionData, $pageName);

  // Build Page (buildPage.php)
  echo buildPageStart(getPageTitle($pageName));
  echo buildHeader($navigationLinks);
  echo startMainSection();
?>
<div class="bg-light-grey page-section">
  <div class="inner-container ">
  <h1 class="mgb-small pastel-accent-clr">Security Assessment</h1>
  <p class="mgb-mid">Web security should be paramount  when developing a web application. Insufficient security can lead to database hacks, and thus catastrophic data loss which can lead to exposure of sensitive user information and/or sensitive company information. </p>
  <h2 class="mgb-small pastel-accent-clr">Security Goals</h2>
  <p class="mgb-mid">To determine the security goals for the website “Galactic Cinema” one must consider the information that is stored on the site. “Defining the goals for the security testing metrics and measurements is a prerequisite for using security testing data for risk analysis and management processes” (OWASP, 2020).
  </p>
  <p class="mgb-mid">The main areas of the web application in question, that need to be protected are:</p>
  <ul class="mgb-mid">
    <li class="security-section-li">All database tables, but specifically the customers table.</li>
    <li class="security-section-li">Users session information</li>
    <li class="security-section-li">Any information displayed to the user as a direct result of database interaction</li>
  </ul>
  <p class="mgb-mid">The database must be sufficiently protected to ensure that an attacker cannot gain access to the customers table and the sensitive information that is stored within. </p>
  <p class="mgb-mid">Alongside this user entered data must be sanitized and validated on input and output. This is to prevent attacks such as Cross Site Scripting (XSS). </p>
  <p class="mgb-mid">One must also consider session fixation attacks. In order to prevent this one must regenerate session IDs and review the content that is stored within the session.</p>
  <h2 class="mgb-small pastel-accent-clr">Entry Points and Trust Zones</h2>
  <p class="mgb-mid">Entry points and trust zones should be considered when designing the system architecture in order to gain an understanding of potential vulnerabilities. For the site “Galactic Cinema” the entry points identified are: </p>
  <ul  class="mgb-mid">
    <li class="security-section-li">Forms that require user input</li>
    <li class="security-section-li">URL parameters that require database interaction</li>
    <li class="security-section-li">Ensuring sensitize client information is hashed/ encrypted</li>
    <li class="security-section-li">Any method on the application layer that requires interaction with the database</li>
    <li class="security-section-li">Output to the page from database items</li>
    <li class="security-section-li">Session data</li>
    <li class="security-section-li">Password Requirements</li>
    <li class="security-section-li">Website source code</li>
  </ul>
  <h2 class="mgb-small pastel-accent-clr">Addressing potential exploits from the trust zones</h2>
  <p class="mgb-mid">All the above trust zones and entry points must be addressed when trying to ensure system integrity is kept while a user/ attacker navigates the site.</p>
  <h2 class="mgb-small pastel-accent-clr">Forms, URLs and Output (SQL injection & XSS)</h2>
  <p class="mgb-mid">Website forms that require user input are a major area of vulnerability. “Most of these vulnerabilities stem from the lack of input validation (D. Balzarotti et al, 2008)”, thus a great deal of attention has been paid to form validation and input/output sanitization. </p>
  <p class="mgb-mid">All forms on the website are validated via a script in the file “validateForms.php”. This file contains the application logic responsible for ensuring no unauthorised data input by a user/attacker is passed to the database.</p>
  <p class="mgb-mid">By validating and sanitizing inputs you can mitigate XSS, “if proper sanitizing is not used, [an] XSS attack is possible” (I. Yusof and A. K. Pathan, 2014). This is why all output based on database items has also been sanitized using an inbuilt php method.</p>
  <p class="mgb-mid">Within the site there are pages that require access to the database to retrieve the correct movie information and display the relevant information in the browser. </p>
  <p class="mgb-mid">To mitigate the chances of SQL injection the parameter (in this case an integer) gets passed to an inbuilt php method that validates the integer. If the parameter is not a valid integer the user will be redirected back to the film listings page.</p>
  <h2 class="mgb-small pastel-accent-clr">Hashing Client Information</h2>
  <p class="mgb-mid">Hashing sensitive client information is extremely important in the event that a database attack is successful. This is done by using an inbuilt password hash method in php. However, it is worth noting this method is fallible if the entered password is weak, thus stricter password requirements should be utilized.</p>
  <h2 class="mgb-small pastel-accent-clr">Database interaction and SQL injection</h2>
  <p class="mgb-mid">“SQL Injection vulnerabilities pose a serious threat to sensitive data and web application security in general”(Fairoz Q et al, 2021).In order to mitigate the chances of a successful SQL injection attack, prepared statements have been used on all actions that require database interaction. </p>
  <p class="mgb-mid">Prepared statements have been shown to be effective in blocking SQL injection by a study done in the Asian Journal of Research in computer science. When penetration testing sites for SQL injection they “demonstrated that SQL injection attacks were not visible on the… prepared Statement website”, whilst sites that did not use these techniques “could be injected into” (Fairoz Q et al, 2021).
  </p>
  <h2 class="mgb-small pastel-accent-clr">Session Data and Session Fixation attacks</h2>
  <p class="mgb-mid">Session data can be vulnerable to session fixation attacks. This is the process of an attacker stealing a user's session information in order to execute actions as an authorised user. “The most crucial piece of information for an attacker is the session identifier”(Shiflett C, 2004). This has been protected by regenerating the session id upon any action that requires database interaction associated with the current user's session.</p>
  <h2 class="mgb-small pastel-accent-clr">Website Source Code</h2>
  <p class="mgb-mid">The website source code represents a major vulnerability to system integrity as this can be manipulated by a user. Thus all inputs must be validated and checked that they meet the given requirements of that input. For example, on the date input of the booking form, the input must be checked to make sure it is not outside of a given range in the application layer else a booking could be placed for before or after a designated date.</p>
  <h2 class="mgb-small pastel-accent-clr">Extra measures </h2>
  <p class="mgb-mid">There are a few areas that are unaddressed within the website, that would be improved upon in further iterations of the project and are beyond the scope of my current knowledge.</p>
  <h2 class="mgb-small pastel-accent-clr">Encryption of sensitive information</h2>
  <p class="mgb-mid">All sensitive information should be encrypted, this is to protect a user as much as possible in the event of a database attack which exposes user information. This alongside stricter password requirements would further protect a user in the situation an attack on the application is successfully executed.</p>
  <h2 class="mgb-small pastel-accent-clr">SSL/ TLS</h2>
  <p class="mgb-mid">The use of an encrypted session would be implemented using Secure Sockets Layer (Transport Layer Security. This allows the encryption of data in transit which mitigates the chances of a man in the middle attack.</p>
  <h2 class="mgb-small pastel-accent-clr">Two Factor Authentication</h2>
  <p class="mgb-mid">This is the process of validating a user (generally on login) by making them confirm their identity via a different device such as a mobile phone. This adds an added layer of security given that an attacker would need access to another device or account.</p>
  <h2 class="mgb-small pastel-accent-clr">Summary</h2>
  <p class="mgb-mid">Maintaining system security is paramount when dealing with sensitive information and user input. Although further checks are needed this represents a good foundation for building a secure web application.</p>
  <br>
  <h2 class="mgb-small pastel-accent-clr">Citations</h2>
  <ol  class="mgb-mid">
    <li class="security-section-li">OWASP (2020) Introduction to Threat Modelling Available at: URL https://owasp.org/www-project-web-security-testing-guide/stable/2-Introduction/README#Threat-Modeling (Accessed: 17th December2021)</li>
    <li class="security-section-li">D. Balzarotti et al., "Saner: Composing Static and Dynamic Analysis to Validate Sanitization in Web Applications," 2008 IEEE Symposium on Security and Privacy (sp 2008), 2008, p.1, doi: 10.1109/SP.2008.22.</li>
    <li class="security-section-li">Kareem F et al, SQL “Injection Attacks Prevention System Technology: Review,” Asian Journal of Research in Computer Science (sp 2021), 2021, pp. 26</li>
    <li class="security-section-li">Kareem F et al, SQL “Injection Attacks Prevention System Technology: Review,” Asian Journal of Research in Computer Science (sp 2021), 2021, pp. 23</li>
    <li class="security-section-li">I. Yusof and A. K. Pathan, "Preventing persistent Cross-Site Scripting (XSS) attack by applying pattern filtering approach," The 5th International Conference on Information and Communication Technology for The Muslim World (ICT4M), 2014, pp. 1-6, doi: 10.1109/ICT4M.2014.7020628. </li>
    <li class="security-section-li">Shiflett C, “PHP Security”, O’Reilly Open Source Convention Portland, Oregon, USA 26 Jul 2004, p.40 </li>
  </ol>
</div>
</div>
<?php 
  echo endMainSection();
  echo buildFooter($navigationLinks);
  echo buildHamburgerBtn();
  echo "<script src='/assets/src/js/mobile-nav.js'></script>";
  echo buildPageEnd();
?>