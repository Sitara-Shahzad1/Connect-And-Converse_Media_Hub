<?php include_once "header.php"; ?>
<?php include_once "top_nav.php"; ?>
<style type="text/css">
<!--
.style1 {font-size: 24px}
a:link {
	color: #FFFFFF;
}
a:hover {
	color: #FF00FF;
}
-->
</style>








<div class="top-brands" style="background-color: white !important">
<div class="container">

<h3> User Login</h3>
<div class="agile_top_brands_grids">


<div class="row">
<div class="col-md-12">
	

<?php 

if(isset($_POST['submit'])){

$email  	= $_POST['email'];
$password  	= $_POST['password'];

$email 		= $db->real_escape_string($email);
$password 	= $db->real_escape_string($password);

$query = "SELECT * FROM users WHERE email = '{$email}' AND password = '{$password}' LIMIT 1";


$result 	= $db->query($query);
$num_row 	= $result->num_rows;

if($num_row == 0){


echo "<p style='font-size:16px; font-weight:bold;color:black' class='alert alert-danger'>Wrong Email, Password OR Registration Request not approved</p>";



}else{

$row = $result->fetch_assoc();

$row_id 		= $row['id'];
$row_role 		= $row['role'];


$_SESSION['id'] 	= $row_id;
$_SESSION['role'] 	= $row_role;

header("Location: backend/index.php"); 
    

  }



}


?>



<form method="post" action="login.php">





<div class="form-group">
<label>Email</label>
<input class="form-control" type="email" name="email" required>
</div>




<div class="form-group">
<label>Password</label>
<input class="form-control" type="password" name="password" required>
</div>





<input type="submit" value="Submit" name="submit" class="btn btn-primary btn-block">


<input type="reset" value="Clear" name="reset" class="btn btn-danger btn-block">

</form>






</div>	
</div>



<div class="clearfix"> </div>
</div>
</div>
</div>

