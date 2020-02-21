<?php
  // Validation
  if( isset($_POST['txtEmail']) && 
      isset($_POST['txtPassword'])
  ){
    $sData = file_get_contents('administrators.json');
    $jData = json_decode($sData);
    // Connect to the database
    $sCorrectEmail      = $jData->email;
    $sCorrectPassword   = $jData->password;
    $sUserEmail         = $_POST['txtEmail'];
    $sUserPassword      = $_POST['txtPassword'];

    if( $sCorrectEmail ==  $sUserEmail &&
        $sCorrectPassword == $sUserPassword &&
        $jData->verified == 1
    ){
      // To start using sessions/cookies 
      session_start();
      // You can put anything in the session
      $_SESSION['sEmail'] = $sUserEmail;
      $_SESSION['sName'] = $jData->name;
      $_SESSION['sEmail'] = $sUserEmail;
      header('Location: admin-dashboard.php');
      exit();
    }
    echo 'Incorrect Login Details';
  }




?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
  <link rel="stylesheet" href="admin.css">
</head>
<body>
  <div id="adminLoginContainer">
    <div id="adminLoginBox">
      <a class="momondo-a" href="index.php"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 250 38" height="38" width="250"><defs><linearGradient id="header-primary" x2="0" y2="100%"><stop offset="0" stop-color="#00d7e5"/><stop offset="1" stop-color="#0066ae"/></linearGradient><linearGradient id="header-secondary" x2="0" y2="100%"><stop offset="0" stop-color="#ff30ae"/><stop offset="1" stop-color="#d1003a"/></linearGradient><linearGradient id="header-tertiary" x2="0" y2="100%"><stop offset="0" stop-color="#ffba00"/><stop offset="1" stop-color="#f02e00"/></linearGradient></defs><path fill="url(#header-primary)" d="M23.2 15.5c2.5-2.7 6-4.4 9.9-4.4 8.7 0 13.4 6 13.4 13.4v12.8c0 .3-.3.5-.5.5h-6c-.3 0-.5-.2-.5-.5V24.5c0-4.6-3.1-5.9-6.4-5.9-3.2 0-6.4 1.3-6.4 5.9v12.8c0 .3-.3.5-.5.5h-5.9c-.3 0-.5-.2-.5-.5V24.5c0-4.6-3.1-5.9-6.4-5.9-3.2 0-6.4 1.3-6.4 5.9v12.8c0 .3-.3.5-.5.5h-6c-.3 0-.5-.2-.5-.5V24.5c0-7.4 4.7-13.4 13.3-13.4 4 0 7.5 1.7 9.9 4.4m54.3 9.1c0 7.5-5.2 13.4-14 13.4s-14-5.9-14-13.4c0-7.6 5.2-13.4 14-13.4 8.8-.1 14 5.9 14 13.4zm-6.7 0c0-3.7-2.4-6.8-7.3-6.8-5.2 0-7.3 3.1-7.3 6.8 0 3.7 2.1 6.8 7.3 6.8 5.1-.1 7.3-3.1 7.3-6.8z"/><path fill="url(#header-secondary)" d="M103.8 15.5c2.5-2.7 6-4.4 9.9-4.4 8.7 0 13.4 6 13.4 13.4v12.8c0 .3-.3.5-.5.5h-5.9c-.3 0-.5-.2-.5-.5V24.5c0-4.6-3.1-5.9-6.4-5.9-3.2 0-6.4 1.3-6.4 5.9v12.8c0 .3-.3.5-.5.5H101c-.3 0-.5-.2-.5-.5V24.5c0-4.6-3.1-5.9-6.4-5.9-3.2 0-6.4 1.3-6.4 5.9v12.8c0 .3-.3.5-.5.5h-5.9c-.3 0-.5-.2-.5-.5V24.5c0-7.4 4.7-13.4 13.3-13.4 3.8 0 7.3 1.7 9.7 4.4m54.3 9.1c0 7.5-5.2 13.4-14 13.4s-14-5.9-14-13.4c0-7.6 5.2-13.4 14-13.4 8.7-.1 14 5.9 14 13.4zm-6.7 0c0-3.7-2.3-6.8-7.3-6.8-5.2 0-7.3 3.1-7.3 6.8 0 3.7 2.1 6.8 7.3 6.8 5.1-.1 7.3-3.1 7.3-6.8zm9.8-.1v12.8c0 .3.2.5.5.5h5.9c.3 0 .5-.2.5-.5V24.5c0-4.6 3.1-5.9 6.4-5.9 3.3 0 6.4 1.3 6.4 5.9v12.8c0 .3.2.5.5.5h5.9c.3 0 .5-.2.5-.5V24.5c0-7.4-4.5-13.4-13.4-13.4-8.7 0-13.2 6-13.2 13.4"/><path fill="url(#header-tertiary)" d="M218.4 0h-5.9c-.3 0-.5.2-.5.5v13c-1.3-1.2-4.3-2.4-7-2.4-8.8 0-14 5.9-14 13.4s5.2 13.4 14 13.4c8.7 0 14-5.2 14-14.6V.4c-.1-.2-.3-.4-.6-.4zm-13.5 31.3c-5.2 0-7.3-3-7.3-6.8 0-3.7 2.1-6.8 7.3-6.8 4.9 0 7.3 3 7.3 6.8s-2.2 6.8-7.3 6.8z"/><path fill="url(#header-tertiary)" d="M236 11.1c-8.8 0-14 5.9-14 13.4s5.2 13.4 14 13.4 14-5.9 14-13.4c0-7.4-5.3-13.4-14-13.4zm0 20.2c-5.2 0-7.3-3.1-7.3-6.8 0-3.7 2.1-6.8 7.3-6.8 4.9 0 7.3 3.1 7.3 6.8 0 3.8-2.2 6.8-7.3 6.8z"/></svg></a>

      <form id="adminLoginForm" action="admin.php" method="POST">
        <label for="txtEmail">Email Address</label>
        <input name="txtEmail" type="text" placeholder="email" value="joshkap2015@gmail.com">
        <label for="txtPassword">Password</label>
        <input name="txtPassword" type="password" placeholder="password" value="admin">
        <button class="blue-btn">LOGIN</button>
      </form>
      <a class="back-btn" href="index.php">← Back to MOMONDO</a>
    </div>
    
  </div>
  <!-- <a href="signup.php">SIGN UP</a> -->

</body>
</html>