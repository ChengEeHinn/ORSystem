<?php
session_start();
include("db.php");

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];

// --- 1. HANDLE DELETION LOGIC ---
if (isset($_GET['delete_id'])) {
    // Sanitize input to prevent SQL injection
    $delete_id = mysqli_real_escape_string($conn, $_GET['delete_id']);
    
    // Ensure the record belongs to the logged-in user before deleting
    $delete_sql = "DELETE FROM lp_problems WHERE id = '$delete_id' AND user_id = '$user_id'";
    
    if (mysqli_query($conn, $delete_sql)) {
        // Redirect back to the same page to refresh the list without query parameters
        header("Location: history.php"); 
        exit();
    } else {
        echo "<script>alert('Error deleting record: " . mysqli_error($conn) . "');</script>";
    }
}

// Fetch history records
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

<div class="container mt-5 mb-5">

    <div class="card shadow">

        <div class="card-header bg-warning text-dark text-center">
            <h3>Budget Allocation History</h3>
        </div>

        <div class="card-body">

            <?php if (mysqli_num_rows($result) == 0) { ?>

                <div class="alert alert-info">
                    No budget allocation records found.
                </div>

            <?php } else { ?>

                <table class="table table-bordered table-striped text-center align-middle">

                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Project Title</th>
                            <th>Activity 1 Qty</th>
                            <th>Activity 2 Qty</th>
                            <th>Total Benefit</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>

                        <tr>
                            <td><?php echo $row["id"]; ?></td>

                            <td><?php echo htmlspecialchars($row["project_title"]); ?></td>

                            <td><?php echo htmlspecialchars($row["optimal_x"]); ?></td>

                            <td><?php echo htmlspecialchars($row["optimal_y"]); ?></td>

                            <td><?php echo htmlspecialchars($row["objective_value"]); ?></td>

                            <td>
                                <a href="result.php?id=<?php echo $row["id"]; ?>"
                                   class="btn btn-sm btn-primary">
                                   View Result
                                </a>
                                
                                <a href="history.php?delete_id=<?php echo $row["id"]; ?>"
                                   class="btn btn-sm btn-danger"
                                   onclick="return confirm('Are you sure you want to delete this record?');">
                                   Delete
                                </a>
                            </td>
                        </tr>

                    <?php } ?>

                    </tbody>

                </table>

            <?php } ?>

            <a href="dashboard.php" class="btn btn-secondary mt-3">
                Back to Dashboard
            </a>

        </div>

    </div>

</div>

</body>
</html>
