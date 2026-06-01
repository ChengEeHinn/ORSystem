<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - ORSystem</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header bg-success text-white">
            <h3>ORSystem Dashboard</h3>
        </div>

        <div class="card-body">

            <h4>
                Welcome,
                <?php echo $_SESSION["user_name"]; ?>
            </h4>

            <hr>

            <div class="row">

                <div class="col-md-4 mb-3">
                    <a href="input.php" class="btn btn-primary w-100">
                        New Optimization
                    </a>
                </div>

                <div class="col-md-4 mb-3">
                    <a href="history.php" class="btn btn-warning w-100">
                        View History
                    </a>
                </div>

                <div class="col-md-4 mb-3">
                    <a href="logout.php" class="btn btn-danger w-100">
                        Logout
                    </a>
                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>