<?php include_once "header.php"; ?> 
<?php include_once "top_nav.php"; ?>

<div class="top-brands" style="background-color: white !important">
    <h3>Create an Account</h3>
    <div class="agile_top_brands_grids">
        <div class="row" style="width:50% !important; margin:0 auto !important">
            <div class="col-md-12">

                <?php 
               
                if (isset($_POST['submit'])) {
                    // Get form inputs
                    $email = $_POST['email'];

                    // Check if the email already exists in the database
                    $check = "SELECT email FROM users WHERE email = ?";
                    $stmt = $db->prepare($check);
                    $stmt->bind_param("s", $email);
                    $stmt->execute();
                    $stmt->store_result();

                    if ($stmt->num_rows > 0) {
                        echo "<p style='font-size:16px; font-weight:bold;color:black' class='alert alert-danger'>Email already Taken.</p>";
                    } else {
                        // Collect other form data
                        $fname = $_POST['fname'];
                        $password = $_POST['password'];
                        $con_password = $_POST['con_password'];
                        $phone = $_POST['phone'];
                        $address = $_POST['address'];
                        $city = $_POST['city'];
                        $cnic = $_POST['cnic'];  // CNIC field
                        $profile_picture = $_FILES['profile_picture']['name'];

                        // Validate CNIC (13 digits)
                        if (!preg_match('/^\d{13}$/', $cnic)) {
                            echo "<p style='font-size:16px; font-weight:bold;color:black' class='alert alert-danger'>Please enter a valid CNIC with 13 digits.</p>";
                        } else {
                            if ($password === $con_password) {
                              

                                // Move uploaded profile picture
                                $profile_picture_tmp = $_FILES['profile_picture']['tmp_name'];
                                $upload_dir = "uploads/";
                                $profile_picture_path = $upload_dir . basename($profile_picture);

                                if (move_uploaded_file($profile_picture_tmp, $profile_picture_path)) {
                                    // Prepare the insert query
                                    $reg_query = "INSERT INTO users (fname, email, password, contact, address, country, profile_picture, cnic) 
                                                  VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

                                    $stmt = $db->prepare($reg_query);
                                    $stmt->bind_param("ssssssss", $fname, $email, $password, $phone, $address, $city, $profile_picture, $cnic);

                                    if ($stmt->execute()) {
                                        echo "<p style='font-size:16px; font-weight:bold;color:black' class='alert alert-success'>Account has been Created Successfully.</p>";
                                    } else {
                                        echo "<p style='font-size:16px; font-weight:bold;color:black' class='alert alert-danger'>Error creating account: " . $stmt->error . "</p>";
                                    }
                                } else {
                                    echo "<p style='font-size:16px; font-weight:bold;color:black' class='alert alert-danger'>Sorry, there was an error uploading your file.</p>";
                                }
                            } else {
                                echo "<p style='font-size:16px; font-weight:bold;color:black' class='alert alert-danger'>Passwords do not match.</p>";
                            }
                        }
                    }
                    $stmt->close();
                }
                ?>

                <form method="post" action="register.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Full Name</label>
                        <input class="form-control" type="text" name="fname" required pattern="[A-Za-z\s]{4,}" title="Name must be at least 4 characters long and contain only letters and spaces">
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" type="email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label>Phone</label>
                        <input class="form-control" type="text" name="phone" required pattern="^03\d{9}$" title="Please enter a valid phone number starting with 03 and followed by 9 digits (e.g., 030012345678)">
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input class="form-control" type="password" name="password" required pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@#$%^&+=!]).{8,}$" title="Password must be at least 8 characters long and contain a combination of letters, numbers, and special characters">
                    </div>

                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input class="form-control" type="password" name="con_password" value="" required pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@#$%^&+=!]).{8,}$" title="Password must be at least 8 characters long and contain a combination of letters, numbers, and special characters">
                    </div>

                    <div class="form-group">
                        <label>About Me</label>
                        <textarea cols="5" rows="5" name="address" required class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Study Program</label>
                        <select class="form-control" name="city" required>
                            <option value="">Choose Program</option>
                            <option value="BSCS">BSCS</option>
                            <option value="BSIT">BSIT</option>
                            <option value="BSSE">BSSE</option>
                            <option value="BSDS">BSDS</option>
                            <option value="BSMGT">BSMGT</option>
                            <option value="BSAI">BSAI</option>
                            <option value="MCS">MCS</option>
                            <option value="MIT">MIT</option>
                            <option value="ADPCS">ADPCS</option>
                            <option value="MSCS">MSCS</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>CNIC (13 digits)</label>
                        <input class="form-control" type="text" name="cnic" required pattern="^\d{13}$" title="CNIC must be 13 digits long">
                    </div>

                    <div class="form-group">
                        <label>Profile Picture</label>
                        <input class="form-control" type="file" name="profile_picture" accept="image/*" required>
                    </div>

                    <input type="submit" value="Submit" name="submit" class="btn btn-primary btn-block">
                    <input type="reset" value="Clear" name="reset" class="btn btn-info btn-block">
                </form>

            </div>
        </div>
    </div>
</div>
</div>
