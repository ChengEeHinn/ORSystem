<?php
session_start();
include("db.php");

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET["id"])) {
    header("Location: history.php");
    exit();
}

$id = intval($_GET["id"]);
$user_id = $_SESSION["user_id"];

$sql = "SELECT * FROM lp_problems 
        WHERE id = $id AND user_id = $user_id";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
    die("Record not found or access denied.");
}

$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Optimization Result - ORSystem</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5 mb-5">

    <div class="card shadow">

        <div class="card-header bg-success text-white text-center">
            <h3>Optimization Result</h3>
        </div>

        <div class="card-body">

            <h4>
                Project:
                <?php echo htmlspecialchars($row["project_title"]); ?>
            </h4>

            <p class="text-muted">
                Campus Event Budget Allocation System
            </p>

            <hr>

            <h5>Objective Function</h5>

            <div class="alert alert-primary">
                <?php echo htmlspecialchars($row["objective_type"]); ?>
                Z =
                <?php echo htmlspecialchars($row["profit_x"]); ?>X +
                <?php echo htmlspecialchars($row["profit_y"]); ?>Y
            </div>

            <hr>

            <h5>Optimal Solution</h5>

            <table class="table table-bordered table-striped text-center">

                <thead class="table-dark">
                    <tr>
                        <th>Decision Variable</th>
                        <th>Description</th>
                        <th>Optimal Value</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>X</td>
                        <td>Activity 1</td>
                        <td><?php echo htmlspecialchars($row["optimal_x"]); ?></td>
                    </tr>

                    <tr>
                        <td>Y</td>
                        <td>Activity 2</td>
                        <td><?php echo htmlspecialchars($row["optimal_y"]); ?></td>
                    </tr>
                </tbody>

            </table>

            <div class="alert alert-success text-center">

                <h4>
                    Optimum Objective Value:
                    <?php echo htmlspecialchars($row["objective_value"]); ?>
                </h4>

            </div>

            <hr>

            <h5>Interpretation</h5>

            <div class="alert alert-info">
                The optimal solution shows the best number of Activity 1 and Activity 2
                that should be selected based on the objective function and constraints entered.
            </div>

            <div class="mt-3">

                <a href="input.php" class="btn btn-primary">
                    New Optimization
                </a>

                <a href="history.php" class="btn btn-warning">
                    View History
                </a>

                <a href="dashboard.php" class="btn btn-secondary">
                    Dashboard
                </a>

            </div>

        </div>

    </div>

</div>

</body>
</html>
