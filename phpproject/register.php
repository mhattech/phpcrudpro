
<?php
require_once "connection.php";

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
$surname = $surname_err =$firstname = $firstname_err ="";
$email = $email_err =$gender_err = $gender = "";
$qualification = $qualification_err = $nationality = $nationality_err="";
$phone_number_err = $phone_number="";

if($_SERVER["REQUEST_METHOD"] == "POST"){

  $username= $_POST["username"];
  $password= $_POST["password"];
  $confirm_password= $_POST["confirm_password"];
  $nationality= $_POST["nationality"];
  $qualification= $_POST["qualification"];
  $firstname= $_POST["firstname"];
  $surname= $_POST["surname"];
  $phone_number = $_POST["phone_number"];
  $email = $_POST["email"];
  $gender= $_POST["gender"];

  if(empty(trim($_POST["username"]))){
    $username_err = "Please enter a username.";
  } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
    $username_err = "Username can only contain letters, numbers, and underscores.";
  } 


 if(empty(trim($_POST["password"]))){
  $password_err = "Please enter a password.";     
  } elseif(strlen(trim($_POST["password"])) < 6){
  $password_err = "Password must have atleast 6 characters.";
  } else{
  $password = trim($_POST["password"]);
  }

   // Validate confirm password
   if(empty(trim($_POST["confirm_password"]))){
  $confirm_password_err = "Please confirm password.";     
   } else{
  $confirm_password = trim($_POST["confirm_password"]);
  if(empty($password_err) && ($password != $confirm_password)){
      $confirm_password_err = "Password did not match.";
  }
 }

 if(empty(trim($_POST["firstname"]))){
  $firstname_err = "please first name is required.";
 } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["firstname"]))){
  $firstname_err_err = "first can only contain letters, numbers, and underscores.";
} 

 if(empty(trim($_POST["surname"]))){
  $surname_err = "please surname is required.";
 } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["surname"]))){
  $surname_err = "surname can only contain letters, numbers, and underscores.";
} 

if (empty($_POST["email"])) {
  $email_err = "Email is required";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $email_err = "Invalid email format";
}
  

if(empty(trim($_POST["phone_number"]))){
  $phone_number_err = "Please phone number is required.";
} elseif(!preg_match('/^[0-9_]+$/', trim($_POST["phone_number"]))){
  $phone_number_err = " phone number can only contain number.";
} elseif(strlen(trim($_POST["phone_number"])) < 10){

  $phone_number_err = "phone number is not more or less than 10.";
}

if(empty(trim($_POST["qualification"]))){
  $qualification_err = "please qualification is required.";
 } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["qualification"]))){
  $qualification_err = "qualification can only contain letters, numbers, and underscores.";

} 
if(empty(trim($_POST["nationality"]))){
  $nationality_err = "please nationality is required.";
 } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["nationality"]))){
  $nationality_err = "nationality can only contain letters, numbers, and underscores.";
} 

if(empty($_POST["gender"])){
  $gender_err = "please gender is required.";
 } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', ($_POST["gender"]))){
  $gender_err = "gender can only contain letters, numbers, and underscores.";
  
} 

if(empty($username_err) && empty($password_err) && empty($confirm_password_err)&& empty($gender_err) && empty($email_err)&& empty($firstname_err)&& empty($surname_err)&& empty($nationality_err)&& empty($qualification_err)){
 
  $stmt = $conn->prepare("INSERT INTO student_table (username,password,firstname, surname, email,phone,qualification,country,gender) VALUES (?, ?, ?,?, ?, ?,?, ?, ?)");
  $stmt->bind_param("sssssssss",$username,$password, $firstname, $surname,$email,$phone_number,$qualification,$nationality, $gender);
  $stmt->execute();

  if($conn){
    header("location: ./index.html");
  }
  else{
      echo "Sorry, could not enter data. Check and try again";
  }
  
}


}
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <title>Register</title>
  <style>
    body {
      font: 14px sans-serif;
    }

    .wrapper {
      width: 360px;
      padding: 20px;

    }
  </style>
</head>

<body>
  <center>
    <div class="wrapper">
      <h2>Register</h2>
      <p>Please fill this form to create an account.</p>
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-group">
          <label>Username</label>
          <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
          <span class="invalid-feedback"><?php echo $username_err; ?></span>
        </div>
        <div class="row">
          
        </div>
        <div class="form-group">
          <label>password</label>
          <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
          <span class="invalid-feedback"><?php echo $password_err; ?></span>
        </div>
        <div class="form-group">
          <label>confirm_password</label>
          <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>">
          <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
        </div>
        <div class="form-group">
          <label>firstname</label>
          <input type="text" name="firstname" class="form-control <?php echo (!empty($firstname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $firstname; ?>">
          <span class="invalid-feedback"><?php echo $firstname_err; ?></span>
        </div>
        <div class="form-group">
          <label>Surname</label>
          <input type="text" name="surname" class="form-control <?php echo (!empty($surname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $surname; ?>">
          <span class="invalid-feedback"><?php echo $surname_err; ?></span>
        </div>
        <div class="form-group">
          <label>Email</label>
          <input type="email" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
          <span class="invalid-feedback"><?php echo $email_err; ?></span>
        </div>

        <div class="form-group">
          <label>phone number</label>
          <input type="phone" name="phone_number" class="form-control <?php echo (!empty($phone_number_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $phone_number; ?>" >
          <span class="invalid-feedback"><?php echo $phone_number_err; ?></span>
        </div>
        <br>

      <div class="row">

        <div class="form-group col-6">
          <select class="form-control custom-select custom-select-sm <?php echo (!empty($qualification_err)) ? 'is-invalid' : ''; ?> " name="qualification" value="<?php echo $qualification; ?>">
            <option value="">Qualification</option>
            <option value="HND">HNN</option>
            <option value="Degree">Degree</option>
            <option value="phd">Phd</option>
          </select>
          <span class="invalid-feedback"><?php echo $qualification_err; ?></span>
        </div>
        
        <br>
        <div class="form-group col-6">
        <select class="form-control custom-select custom-select-sm <?php echo (!empty($nationality_err)) ? 'is-invalid' : ''; ?> " name="nationality" value="<?php echo $nationality; ?>">
          <option value="">Nationality</option>
          <option value="ghana">Ghana</option>
          <option value="nigeria">Nigeria</option>
          <option value="togo">Togo</option>
        </select>
        <span class="invalid-feedback"><?php echo $nationality_err; ?></span>
        </div>
      </div>
        <br>

        <br>
        <div class="row">
          <div class="custom-control col-6 <?php echo (!empty($gender_err)) ? 'is-invalid' : ''; ?>">
            <input type="radio"  name="gender" value="male" class="custom-control-input">
            <label style="color: black;" class="custom-control-label" for="customRadioInline1">MALE</label>
          </div>

          <div class="custom-control  col-6 <?php echo (!empty($gender_err)) ? 'is-invalid' : ''; ?>">
            <input type="radio"  name="gender" value="female" class="custom-control-input">
            <label style="color: black;" class="custom-control-label" for="customRadioInline2">FEMALE</label>
            
          </div>
          <span class="invalid-feedback"><?php echo $gender_err; ?></span>
        </div>
                   <br>

        <div class="form-row d-flex justify-content-between">
          <a class="col-4 btn btn-primary" href="login.php">Cancel</a>
          <button class="col-4 btn btn-primary" name="register" type="submit">Register</button>
        </div>

      </form>

    </div>







    </div>


    </div>
  </center>
</body>

</html>