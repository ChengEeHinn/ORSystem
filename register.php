<?php
include("db.php");

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $full_name = trim($_POST["full_name"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    if ($password != $confirm_password) {

        $message = "Passwords do not match!";

    } else {

        $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

        if (mysqli_num_rows($check) > 0) {

            $message = "Email already exists!";

        } else {

            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO users (full_name, email, password)
                    VALUES ('$full_name', '$email', '$hashed_password')";

            if (mysqli_query($conn, $sql)) {

                header("Location: login.php");
                exit();

            } else {

                $message = "Registration failed!";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register - ORSystem</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card mx-auto shadow" style="max-width:550px;">

        <div class="card-header text-center bg-success text-white">
            <h3>Create ORSystem Account</h3>
        </div>

        <div class="card-body">

            <?php if ($message != "") { ?>
                <div class="alert alert-danger">
                    <?php echo $message; ?>
                </div>
            <?php } ?>

            <form method="POST">

                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text"
                           name="full_name"
                           class="form-control"
                           placeholder="Enter your full name"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <input type="email"
                           name="email"
                           class="form-control"
                           placeholder="Enter your email"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password"
                           name="password"
                           class="form-control"
                           placeholder="Enter password"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Confirm Password</label>
                    <input type="password"
                           name="confirm_password"
                           class="form-control"
                           placeholder="Confirm password"
                           required>
                </div>

                <button type="submit" class="btn btn-success w-100">
                    Register
                </button>

            </form>

            <div class="text-center mt-3">
                Already have an account?
                <a href="login.php">Login Here</a>
            </div>

            <div class="text-center mt-2">
                <a href="index.php">Back to Home</a>
            </div>

        </div>

    </div>

</div>

</body>
</html>
