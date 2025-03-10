<?php
require('top.inc.php');
isAdmin();

$username = '';
$password = '';
$email = '';
$mobile = '';
$msg = '';
$errors_email = '';
$errors_mobile = '';
$errors_password = '';
$errors_username = '';

if (isset($_GET['id']) && $_GET['id'] != '') {
    $id = get_safe_value($con, $_GET['id']);
    $res = mysqli_query($con, "SELECT * FROM admin_users WHERE id='$id'");
    $check = mysqli_num_rows($res);

    if ($check > 0) {
        $row = mysqli_fetch_assoc($res);
        $username = $row['username'];
        $email = $row['email'];
        $mobile = $row['mobile'];
        $password = $row['password'];
    } else {
        header('location:vendor_management.php');
        die();
    }
}

if (isset($_POST['submit'])) {
    $username = get_safe_value($con, $_POST['username']);
    $email = get_safe_value($con, $_POST['email']);
    $mobile = get_safe_value($con, $_POST['mobile']);
    $password = get_safe_value($con, $_POST['password']);
    $errors = [];

    // Email Validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors_email = "Invalid email format.";
    }

    // Mobile Validation (Must be exactly 10 digits)
    if (!preg_match('/^[0-9]{10}$/', $mobile)) {
        $errors_mobile = "Mobile number must be exactly 10 digits.";
    }

    // Password Validation (At least 6 characters)
    if (strlen($password) < 6) {
        $errors_password = "Password must be at least 6 characters.";
    }

    // Check if username already exists
    $res = mysqli_query($con, "SELECT * FROM admin_users WHERE username='$username'");
    $check = mysqli_num_rows($res);
    if ($check > 0) {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            $getData = mysqli_fetch_assoc($res);
            if ($id != $getData['id']) {
                $errors_username = "Username already exists.";
            }
        } else {
            $errors_username = "Username already exists.";
        }
    }

    // Insert or Update Data if No Errors
    if (empty($errors_email) && empty($errors_mobile) && empty($errors_password) && empty($errors_username)) {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            $update_sql = "UPDATE admin_users SET username='$username', password='$password', email='$email', mobile='$mobile' WHERE id='$id'";
            mysqli_query($con, $update_sql);
        } else {
            mysqli_query($con, "INSERT INTO admin_users (username, password, email, mobile, role, status) VALUES ('$username', '$password', '$email', '$mobile', 1, 1)");
        }
        header('location:vendor_management.php');
        die();
    } else {
        $msg = implode('<br>', $errors); // Show all error messages
    }
}
?>

<div class="content pb-0">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><strong>Vendor Management</strong><small> Form</small></div>
                    <form method="post" enctype="multipart/form-data">
                        <div class="card-body card-block">
                            <div class="form-group">
                                <label for="username" class="form-control-label">Username</label>
                                <input type="text" name="username" placeholder="Enter username" class="form-control" required value="<?php echo htmlspecialchars($username); ?>">
                                <small class="text-danger" id="username_error"><?php echo $errors_username; ?></small>
                            </div>
                            <div class="form-group">
                                <label for="password" class="form-control-label">Password</label>
                                <input type="password" name="password" placeholder="Enter password" class="form-control" required value="<?php echo htmlspecialchars($password); ?>">
                                <small class="text-danger" id="password_error"><?php echo $errors_password; ?></small>
                            </div>
                            <div class="form-group">
                                <label for="email" class="form-control-label">Email</label>
                                <input type="email" name="email" placeholder="Enter email" class="form-control" required value="<?php echo htmlspecialchars($email); ?>">
                                <small class="text-danger" id="email_error"><?php echo $errors_email; ?></small>
                            </div>
                            <div class="form-group">
                                <label for="mobile" class="form-control-label">Mobile</label>
                                <input type="text" name="mobile" placeholder="Enter mobile" class="form-control" required value="<?php echo htmlspecialchars($mobile); ?>">
                                <small class="text-danger" id="mobile_error"><?php echo $errors_mobile; ?></small>
                            </div>
                            <button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
                                <span id="payment-button-amount">Submit</span>
                            </button>
                        
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require('footer.inc.php'); ?>
