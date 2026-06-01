<?php
session_start();
include("db.php");

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET["id"])) {
    header("Location: dashboard.php");
    exit();
}

$id = intval($_GET["id"]);

$sql = "SELECT * FROM lp_problems WHERE id = $id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
    die("Record not found.");
}

$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Optimization Result - ORSystem</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header bg-success text-white">
            <h3>Optimization Result</h3>
        </div>

        <div class="card-body">

            <h4>
                Project:
                <?php echo htmlspecialchars($row["project_title"]); ?>
            </h4>

            <hr>

            <h5>Objective Function</h5>

            <p>
                <?php echo $row["objective_type"]; ?>
                Z =
                <?php echo $row["profit_x"]; ?>X +
                <?php echo $row["profit_y"]; ?>Y
            </p>

            <hr>

            <h5>Optimal Solution</h5>

            <table class="table table-bordered">

                <tr>
                    <th>Decision Variable</th>
                    <th>Value</th>
                </tr>

                <tr>
                    <td>X</td>
                    <td><?php echo $row["optimal_x"]; ?></td>
                </tr>

                <tr>
                    <td>Y</td>
                    <td><?php echo $row["optimal_y"]; ?></td>
                </tr>

            </table>

            <div class="alert alert-success">

                <h4>
                    Optimum Objective Value:
                    <?php echo $row["objective_value"]; ?>
                </h4>

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