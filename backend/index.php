<?php include_once "header.php"; ?>

<div id="wrapper">

<!----->

<?php if($user_role == 'admin'){ ?>



<?php include_once "admin_sidebar.php"; ?>


<div id="page-wrapper" class="gray-bg dashbard-1">
<div class="content-main">

<div class="content-top">


<div class="col-md-3">
<div class="content-top-1">


<p>Admin Information</p>

</div>
</div>



<div class="col-md-9">
<div class="content-top-1">




<table class="table table-bordered">
	
<?php 

$query_data = "SELECT * from users WHERE id = '{$user_id}' ";
$result = $db->query($query_data);
$row = $result->fetch_assoc();

$name = $row['name'];
$email = $row['email'];
$contact = $row['contact'];
$role = $row['role'];



?>
	<tr>
		<th>Name</th>
		<th>Email</th>
		<th>Contact</th>
		<th>Role</th>
	</tr>

	<tr>

		<td><?php echo ucfirst($name); ?></td>
		<td><?php echo $email; ?></td>
		<td><?php echo $contact; ?></td>
		<td><?php echo ucfirst($role); ?></td>
		
	</tr>

</table>




</div>
</div>




<div class="clearfix"> </div>
</div>


<?php }elseif($user_role == 'user'){ ?>





<?php include_once "sidebar.php"; ?>


<div id="page-wrapper" class="gray-bg dashbard-1">
<div class="content-main">

<div class="content-top">


<div class="col-md-2">
<div class="content-top-1">

<p>Your Info</p>


</div>
</div>



<div class="col-md-10">
<div class="content-top-1">

<table class="table table-bordered">
	
<?php 

$query_data = "SELECT * from users WHERE id = '{$user_id}' ";
$result = $db->query($query_data);
$row = $result->fetch_assoc();

$name = $row['fname'];
$email = $row['email'];
$contact = $row['contact'];
$img = $row['profile_picture'];
$cnic = $row['cnic'];
$program = $row['country'];
$about = $row['address'];


?>
	<tr><th>Profile Picture</th>
		<th>Name</th>
		<th>Email</th>
		<th>Contact</th>
		<th>CNIC</th>
		<th>Study Program</th>
		<th>About Me</th>
	</tr>

	<tr>
		<td><img src="../uploads/<?php echo $img ; ?>" class="img-responsive img-thumbnail"></td>

		<td><?php echo ucfirst($name); ?></td>
		<td><?php echo $email; ?></td>
		<td><?php echo $contact; ?></td>
		<td><?php echo ucfirst($cnic); ?></td>

		<td><?php echo ucfirst($program); ?></td>
		<td><?php echo ucfirst($about); ?></td>
		
	</tr>

</table>


</div>
</div>




<div class="clearfix"> </div>
</div>



<?php }else{header("Location: logout.php"); } ?>





<?php include_once "footer.php"; ?>

