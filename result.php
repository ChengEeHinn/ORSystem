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

$budget_used = ($row["c1_x"] * $row["optimal_x"]) + ($row["c1_y"] * $row["optimal_y"]);
$budget_remaining = $row["c1_rhs"] - $budget_used;

$volunteer_used = ($row["c2_x"] * $row["optimal_x"]) + ($row["c2_y"] * $row["optimal_y"]);
$volunteer_remaining = $row["c2_rhs"] - $volunteer_used;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Budget Allocation Result - ORSystem</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5 mb-5">

    <div class="card shadow">

        <div class="card-header bg-success text-white text-center">
            <h3>Recommended Budget Allocation Result</h3>
        </div>

        <div class="card-body">

            <h4>Project: <?php echo htmlspecialchars($row["project_title"]); ?></h4>

            <p class="text-muted">
                Campus Event Budget Allocation System
            </p>

            <hr>

            <h5>Recommended Activities</h5>

            <table class="table table-bordered table-striped text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Activity</th>
                        <th>Recommended Quantity</th>
                        <th>Benefit Per Unit</th>
                        <th>Total Benefit</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>Activity 1</td>
                        <td><?php echo htmlspecialchars($row["optimal_x"]); ?></td>
                        <td><?php echo htmlspecialchars($row["profit_x"]); ?></td>
                        <td><?php echo htmlspecialchars($row["optimal_x"] * $row["profit_x"]); ?></td>
                    </tr>

                    <tr>
                        <td>Activity 2</td>
                        <td><?php echo htmlspecialchars($row["optimal_y"]); ?></td>
                        <td><?php echo htmlspecialchars($row["profit_y"]); ?></td>
                        <td><?php echo htmlspecialchars($row["optimal_y"] * $row["profit_y"]); ?></td>
                    </tr>
                </tbody>
            </table>

            <div class="alert alert-success text-center">
                <h4>
                    Maximum Total Benefit:
                    <?php echo htmlspecialchars($row["objective_value"]); ?>
                </h4>
            </div>

            <hr>

            <h5>Resource Usage Summary</h5>

            <table class="table table-bordered text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Resource</th>
                        <th>Available</th>
                        <th>Used</th>
                        <th>Remaining</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>Budget (RM)</td>
                        <td><?php echo htmlspecialchars($row["c1_rhs"]); ?></td>
                        <td><?php echo number_format($budget_used, 2); ?></td>
                        <td><?php echo number_format($budget_remaining, 2); ?></td>
                    </tr>

                    <tr>
                        <td>Volunteer Hours</td>
                        <td><?php echo htmlspecialchars($row["c2_rhs"]); ?></td>
                        <td><?php echo number_format($volunteer_used, 2); ?></td>
                        <td><?php echo number_format($volunteer_remaining, 2); ?></td>
                    </tr>
                </tbody>
            </table>

            <hr>

            <h5>System Interpretation</h5>

            <div class="alert alert-info">
                The system recommends choosing
                <strong><?php echo htmlspecialchars($row["optimal_x"]); ?></strong>
                unit(s) of Activity 1 and
                <strong><?php echo htmlspecialchars($row["optimal_y"]); ?></strong>
                unit(s) of Activity 2 because this combination gives the highest total benefit
                without exceeding the available budget, volunteer hours, and activity limit.
            </div>

            <div class="mt-3">

                <a href="input.php" class="btn btn-primary">
                    New Recommendation
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
