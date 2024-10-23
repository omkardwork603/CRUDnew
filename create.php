<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "myshop";

$connection = new mysqli($servername, $username, $password, $database);

$name = "";
$email = "";
$phone = "";
$address = "";
$image = "";
$course = "";
$gender = "";
$errorMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $course = $_POST['course'];
    $gender = $_POST['gender'];

    // Handle file upload for image
    if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image = 'uploads/' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $image);
    } else {
        $errorMessage = "Image upload failed.";
    }

    if (empty($name) || empty($email) || empty($phone) || empty($address) || empty($course) || empty($gender)) {
        $errorMessage = "All fields are required.";
    } else {
        $sql = "INSERT INTO clients(name, email, phone, address, image, course, gender) VALUES ('$name', '$email', '$phone', '$address', '$image', '$course', '$gender')";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
        } else {
            header("location:index.php");
            exit;
        }
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <title>Add Client</title>
</head>
<body>
            
<div class="container">
    <h1>CRUD Application</h1>
        <div class="container"></div>
    <div class="row">
        <a href="index.php" class="btn btn-secondary">Back</a>
        <div class="col-md-12">
            <form method="post" enctype="multipart/form-data">
                <label>Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter the name" required>

                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="Enter the email" required>

                <label>Phone</label>
                <input type="text" name="phone" class="form-control" placeholder="Enter the phone" required>

                <label>Address</label>
                <input type="text" name="address" class="form-control" placeholder="Enter the address" required>

                <label>Course</label>
                <input type="text" name="course" class="form-control" placeholder="Enter the course" required>

                <label>Gender</label>
                <select name="gender" class="form-control" required>
                    <option value="">Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>

                <label>Image</label>
                <input type="file" name="image" class="form-control" required>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
