<?php

include_once 'connection.php';
include_once 'session.php';

$result = mysqli_query($conn,"SELECT * FROM student_table");

?>
<!DOCTYPE html>
<html>
 <head>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
 <title> Retrive data</title>
 </head>

 <style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
width: 140px;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
#register{

 float: right;
 margin-right: 150px;
 height: 40px;
}
#logout{
    float: right;
    width: 100px;
    position: relative;
    right:80px;
  
}
a{
    text-decoration: none;
}
</style>
<body>
<?php
if (mysqli_num_rows($result) > 0) {



?>

 <button class=" btn btn-primary btn-danger  " name="loggout" type="logout" id="logout"  > <a href="loggout.php">logout</a></button>
 <a href="./register.php"><i class=" btn btn-primary fa fa-plus-square " id="register">add new</i></a>
</button></td>
<center>


  <table>
  <tr name="row" >
    <td>User_id</td>
    <br>
    <td>User name</td>
    <br>
    <td>Password</td>
    <td>First Name</td>
    <td>Sur Name</td>
    <td>Email</td>
    <td>Phone Number</td>
    <td>Qualification</td>
    <td>Nationality</td>
    <td>Gender</td>
    <td>Edit</td>
    <td>Delete</td>

  </tr>
<?php
$i=0;
while($row = mysqli_fetch_array($result)) {

?>
<tr>
    <td><?php echo $row["reg_id"]; ?></td>
    <td><?php echo $row["username"]; ?></td>
    <td><?php echo $row["password"]; ?></td>
    <td><?php echo $row["firstname"]; ?></td>
    <td><?php echo $row["surname"]; ?></td>
    <td><?php echo $row["email"]; ?></td>
    <td><?php echo $row["phone"]; ?></td>
    <td><?php echo $row["qualification"]; ?></td>
    <td><?php echo $row["country"]; ?></td>
    <td><?php echo $row["gender"]; ?></td>
    <td> <a href="update.php?reg_id=<?php echo $row['reg_id'] ?>"><i class=" btn btn-primary  btn-success  <?php echo $row['reg_id'] ?>">Edit</i></a></td>
    <td><button class=" btn btn-primary  btn-danger fa fa-trash " onclick="myFunction(<?php echo $row['reg_id'] ?>)" > delete</button></td>
   
</tr>
<?php
$i++;
}


?>
</table> 
 <!-- <?php
}
else{
    echo "No result found";
}
?> -->
</center>
<script>
	function myFunction($reg_id) {
//   let text = "Press a button!\nEither OK or Cancel.";
  if (confirm('Confirm Delete') == true) {
	window.location.href = "delete.php?reg_id=" + $reg_id;
  } else {
    // text = 'header("Refresh:0")';
    console.log('canceled')
  }
//   document.getElementById("demo").innerHTML = text;
}
</script>
 </body>
</html>