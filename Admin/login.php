<?php
require('connection.inc.php');
require('functions.inc.php');
$msg = '';
if (isset($_POST['submit'])) {
   $username = get_safe_value($con, $_POST['username']);
   $password = get_safe_value($con, $_POST['password']);
   $sql = "SELECT * FROM admin_users WHERE username='$username' AND password='$password'";
   $res = mysqli_query($con, $sql);
   $count = mysqli_num_rows($res);
   if ($count > 0) {
      $row = mysqli_fetch_assoc($res);
      if ($row['status'] == '0') {
         $msg = "Account deactivated";
      } else {
         $_SESSION['ADMIN_LOGIN'] = 'yes';
         $_SESSION['ADMIN_ID'] = $row['id'];
         $_SESSION['ADMIN_USERNAME'] = $username;
         $_SESSION['ADMIN_ROLE'] = $row['role'];
         header('location:categories.php');
         die();
      }
   } else {
      $msg = "Incorrect login details";
   }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Wedding Attire Hire | Admin Login</title>
   <link rel="stylesheet" href="assets/css/bootstrap.min.css">
   <link rel="stylesheet" href="assets/css/style.css">
   <style>
     body {
    background-color: #eef2f3;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
    font-family: 'Poppins', sans-serif;
}

.container {
    width: 100%;
    display: flex;
    justify-content: center;
}

.login-container {
    width: 100%;
    max-width: 400px;
    background: white;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.login-container h2 {
    color: #333;
    font-size: 24px;
    margin-bottom: 20px;
    font-weight: 600;
}

.form-group {
    text-align: left;
    margin-bottom: 15px;
}

label {
    font-weight: 600;
    font-size: 14px;
    display: block;
    margin-bottom: 5px;
    color: #555;
}

.form-control {
    width: 100%;
    padding: 12px;
    font-size: 14px;
    border: 1px solid #ccc;
    border-radius: 8px;
    outline: none;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: #5aaf76;
    box-shadow: 0 0 5px rgba(90, 175, 118, 0.5);
}

.btn-login {
    background-color: #5aaf76;
    color: white;
    width: 100%;
    padding: 12px;
    font-size: 16px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.btn-login:hover {
    background-color: #4d9965;
}

.field_error {
    color: red;
    font-size: 14px;
    margin-top: 10px;
    font-weight: 500;
}
   </style>
</head>

<body>
   <div class="container">
      <div class="login-container">
         <h2>WAH-Dashboard</h2>
         <form method="post">
            <div class="form-group">
               <label>Username</label>
               <input type="text" name="username" class="form-control" placeholder="Enter Username" required>
            </div>
            <div class="form-group">
               <label>Password</label>
               <input type="password" name="password" class="form-control" placeholder="Enter Password" required>
            </div>
            <button type="submit" name="submit" class="btn btn-login">Sign In</button>
            <div class="field_error"> <?php echo $msg; ?> </div>
         </form>
      </div>
   </div>
   
   <script src="assets/js/jquery.min.js"></script>
   <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>