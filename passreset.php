<?php
ini_set("include_path", '/home/user/php:' . ini_get("include_path") );
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_STRICT);

require_once "Mail.php";

// Include config file
require_once "config.php";

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

// Define variables and initialize with empty values

$email = $password = $confirm_password = "";
$email_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

// Validate email
    if(empty(trim($_POST["email"]))){
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE email= ?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);

            // Set parameters
            $param_email = trim($_POST["email"]);

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){
		$authcode = generateRandomString(10);
// Prepare an insert statement
        $sql = "INSERT INTO passwordResets (email, authcode) VALUES (?, ?)";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $_POST["email"], $authcode);
	    $param_email = $email;
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $email = trim($_POST["email"]);
		            $host = "ssl://dlscord.gift";
		            $username = "admin@dlscord.gift";
		            $password = "oe}n8_mMqOp-";
		            $port = "465";
		            $to = $_POST["email"];
		            $email_from = "admin@dlscord.gift";
		            $email_subject = "Password reset request.";
		            $email_body = "https://dlscord.gift/webpanel/newpass.php?id=" . $authcode;
		            $email_address = "admin@dlscord.gift";

		            $headers = array ('From' => $email_from, 'To' => $to, 'Subject' => $email_subject, 'Reply-To' => $email_address);
		            $smtp = Mail::factory('smtp', array ('host' => $host, 'port' => $port, 'auth' => true, 'username' => $username, 'password' => $password));
		            $mail = $smtp->send($to, $headers, $email_body);
                } else{
                  echo "Something went wrong. Please try again later.";
                }

            // Close statement
            mysqli_stmt_close($stmt);
      	}
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
    }

    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Password Reset</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Password Reset</h2>
        <p>Please enter your email and you will receive a password reset link.</p>
        <p>Password reset is only possible if you added an email to your account upon registration.</p>
        <p>Check your spam folder.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
	    <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>Email</label>
                <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
        </form>
    </div>
</body>
</html>