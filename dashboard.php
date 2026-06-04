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

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header bg-success text-white text-center">
            <h2>Campus Event Budget Allocation System</h2>
        </div>

        <div class="card-body">

            <h4>
                Welcome,
                <span class="text-primary">
                    <?php echo $_SESSION["user_name"]; ?>
                </span>
            </h4>

            <p class="text-muted">
                Linear Programming Decision Support System
            </p>

            <hr>

            <div class="alert alert-info">
                <strong>Project Objective:</strong><br>
                Help student clubs allocate budgets efficiently for activities such as
                Catering, Marketing, and Equipment while maximizing event effectiveness.
            </div>

            <div class="row">

                <div class="col-md-3 mb-3">
                    <a href="input.php" class="btn btn-primary w-100">
                        New Optimization
                    </a>
                </div>

                <div class="col-md-3 mb-3">
                    <a href="history.php" class="btn btn-warning w-100">
                        View History
                    </a>
                </div>

                <div class="col-md-3 mb-3">
                    <a href="result.php" class="btn btn-info w-100">
                        Latest Result
                    </a>
                </div>

                <div class="col-md-3 mb-3">
                    <a href="logout.php" class="btn btn-danger w-100">
                        Logout
                    </a>
                </div>

            </div>

            <hr>

            <h5>System Features</h5>

            <ul class="list-group">

                <li class="list-group-item">
                    Enter budget allocation data
                </li>

                <li class="list-group-item">
                    Store optimization problems in MySQL database
                </li>

                <li class="list-group-item">
                    Calculate optimal allocation solution
                </li>

                <li class="list-group-item">
                    Display optimization results
                </li>

                <li class="list-group-item">
                    View historical records
                </li>

            </ul>

        </div>

        <div class="card-footer text-center text-muted">
            ORSystem © 2026 | Operational Research Group Project
        </div>

    </div>

</div>

</body>
</html>
