<?php



session_start();
// // Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: user.php");
    exit;
}

require_once "connection.php";

$username = $password = "";
$username_err = $password_err = $login_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
   $remember_me = $_POST["remember_me"];

   if($remember_me == 1){

    setcookie("username",$_POST["username"] , time() + (86400 * 30), "/");

    setcookie("password", $_POST["password"], time() + (86400 * 30), "/");
   }

    // Check if username is empty
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter username.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if (empty($username_err) && empty($password_err)) {
        // prepare and bind
        $stmt = $conn->prepare("SELECT reg_id, username, password  FROM student_table WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $username, $password);
              
        // // set parameters and execute
        $username = trim($_POST["username"]);
        $password = trim($_POST["password"]);
        $stmt->execute();

        $result = $stmt->get_result();
        $result = mysqli_fetch_assoc($result);
        
        // print_r($result->fetch_assoc());
        // print_r($result);
        // echo count($result);

        if($result && count($result) == 3){
             session_start();
            // Store data in session variables
            $_SESSION["loggedin"] = true;
            $_SESSION["reg_id"] = $result['reg_id'];
            $_SESSION["username"] = $result['username'];  
            $_SESSION["password"] = $result['password'];                                 
            
            // Redirect user to welcome page
            header('location: http://localhost/phpproject/user.php');
        } else{
            // Password is not valid, display a generic error message
            $login_err = "Invalid username or password.";

        }
        
    }

      

    

    // Close connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <title>login</title>
  <style>
    body {
      font: 14px sans-serif;
    }

    .wrapper {
      width: 360px;
      padding: 20px;

    }
    .remember{
      position: absolute;

      top: 230px;      


    }
  </style>
</head>
<body>
    <center>
 <div class="wrapper">
 <h2>Sighn In</h2>
      <p>Please fill this form to login.</p>

      <?php
            if (!empty($login_err)) {
                echo '<div class="alert alert-danger">' . $login_err . '</div>';
            }
        ?>

      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-group">
          <label>Username</label>
          <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php if(isset($_COOKIE["username"])) echo $_COOKIE["username"];?>">
          <span class="invalid-feedback"><?php echo $username_err; ?></span>
        </div>
        <div class="row">
          
        </div>
        <div class="form-group">
          <label>password</label>
          <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php if(isset($_COOKIE["password"])) echo $_COOKIE["password"];?>" >
          <span class="invalid-feedback"><?php echo $password_err; ?></span>
        </div>
        <br>
        <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Login">
                </div>
                <div class="remember">

                <input type="checkbox" name="remember_me" id="remember_me"
                    value="1" />
                Remember Me

                </div>
                
            
                <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
    </form>
   </div>
    </center>
</body>
</html>