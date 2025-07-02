<?php include_once "header.php"; ?>

<div id="wrapper">

<?php if($user_role == 'admin'){ ?>

<?php include_once "admin_sidebar.php"; ?>

<div id="page-wrapper" class="gray-bg dashbard-1">
<div class="content-main">
<div class="content-top">

<?php } elseif($user_role == 'user'){ ?>

<?php include_once "sidebar.php"; ?>

<div id="page-wrapper" class="gray-bg dashbard-1">
<div class="content-main">
<div class="content-top">

<div class="col-md-12">
<div class="content-top-1">

    <h3> View All Users </h3>
    <hr>

<?php 
// Check for sorting order
$sort_order = isset($_GET['sort_order']) ? $_GET['sort_order'] : 'ASC'; 
$sort_column = isset($_GET['sort_column']) ? $_GET['sort_column'] : 'fname'; // Default to sorting by 'fname'

// Toggle sorting order for the next click
$new_sort_order = ($sort_order == 'ASC') ? 'DESC' : 'ASC';

$query_data = "SELECT * FROM users ORDER BY $sort_column $sort_order";
$result = $db->query($query_data);
?>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Profile Picture</th>
            <th><a href="?sort_column=fname&sort_order=<?php echo $new_sort_order; ?>">User ID</a></th>
            <th><a href="?sort_column=fname&sort_order=<?php echo $new_sort_order; ?>">Name</a></th>
            <th><a href="?sort_column=email&sort_order=<?php echo $new_sort_order; ?>">Email</a></th>
            <th><a href="?sort_column=contact&sort_order=<?php echo $new_sort_order; ?>">Contact</a></th>
            <th><a href="?sort_column=cnic&sort_order=<?php echo $new_sort_order; ?>">CNIC</a></th>
            <th><a href="?sort_column=country&sort_order=<?php echo $new_sort_order; ?>">Study Program</a></th>
            <th><a href="?sort_column=address&sort_order=<?php echo $new_sort_order; ?>">About Me</a></th>
        </tr>
    </thead>
    <tbody>
    <?php while ($row = $result->fetch_assoc()) { 
        $user_id = $row['id'];
        $name = $row['fname'];
        $email = $row['email'];
        $contact = $row['contact'];
        $img = $row['profile_picture'];
        $cnic = $row['cnic'];
        $program = $row['country'];
        $about = $row['address'];
    ?>
        <tr>
            <td><img src="../uploads/<?php echo $img; ?>" class="img-responsive img-thumbnail"></td>
            <td><?php echo $user_id; ?></td>
            <td><?php echo ucfirst($name); ?></td>
            <td><?php echo $email; ?></td>
            <td><?php echo $contact; ?></td>
            <td><?php echo ucfirst($cnic); ?></td>
            <td><?php echo ucfirst($program); ?></td>
            <td><?php echo ucfirst($about); ?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>

</div>
</div>
<div class="clearfix"> </div>
</div>

<?php } else { header("Location: logout.php"); } ?>

<?php include_once "footer.php"; ?>
