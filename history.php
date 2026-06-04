<?php
session_start();
include("db.php");

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];

$sql = "SELECT * FROM lp_problems
        WHERE user_id = '$user_id'
        ORDER BY created_at DESC";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>History - ORSystem</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header bg-warning text-dark text-center">
            <h3>Optimization History</h3>
        </div>

        <div class="card-body">

            <?php if (mysqli_num_rows($result) == 0) { ?>

                <div class="alert alert-info">
                    No optimization records found.
                </div>

            <?php } else { ?>

                <div class="table-responsive">

                    <table class="table table-bordered table-striped table-hover text-center">

                        <thead class="table-dark">

                            <tr>
                                <th>ID</th>
                                <th>Project Title</th>
                                <th>Objective Type</th>
                                <th>Optimal X</th>
                                <th>Optimal Y</th>
                                <th>Objective Value</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>

                        </thead>

                        <tbody>

                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>

                            <tr>

                                <td><?php echo $row["id"]; ?></td>

                                <td><?php echo htmlspecialchars($row["project_title"]); ?></td>

                                <td><?php echo htmlspecialchars($row["objective_type"]); ?></td>

                                <td><?php echo $row["optimal_x"]; ?></td>

                                <td><?php echo $row["optimal_y"]; ?></td>

                                <td><?php echo $row["objective_value"]; ?></td>

                                <td><?php echo $row["created_at"]; ?></td>

                                <td>
                                    <a href="result.php?id=<?php echo $row["id"]; ?>"
                                       class="btn btn-sm btn-primary">
                                       View
                                    </a>
                                </td>

                            </tr>

                        <?php } ?>

                        </tbody>

                    </table>

                </div>

            <?php } ?>

            <a href="dashboard.php" class="btn btn-secondary mt-3">
                Back to Dashboard
            </a>

        </div>

    </div>

</div>

</body>
</html>
