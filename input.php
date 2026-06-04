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
    <title>New Budget Allocation - ORSystem</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5 mb-5">

    <div class="card shadow">

        <div class="card-header bg-primary text-white text-center">
            <h3>Campus Event Budget Allocation Input</h3>
        </div>

        <div class="card-body">

            <div class="alert alert-info">
                <strong>Simple Explanation:</strong><br>
                Activity 1 = X, Activity 2 = Y.  
                The system will decide the best quantity for both activities.
            </div>

            <form action="solve.php" method="POST">

                <div class="mb-3">
                    <label class="form-label">Event / Project Title</label>
                    <input type="text"
                           name="project_title"
                           class="form-control"
                           placeholder="Example: Campus Sports Day Budget Allocation"
                           required>
                </div>

                <input type="hidden" name="objective_type" value="Maximize">

                <hr>

                <h5>Activity Benefit</h5>
                <p class="text-muted">
                    Enter how many students can benefit from one unit of each activity.
                </p>

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label>Activity 1 Benefit Score</label>
                        <input type="number"
                               step="any"
                               name="profit_x"
                               class="form-control"
                               placeholder="Example: 50"
                               required>
                        <small class="text-muted">Example: Catering benefits 50 students.</small>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Activity 2 Benefit Score</label>
                        <input type="number"
                               step="any"
                               name="profit_y"
                               class="form-control"
                               placeholder="Example: 38"
                               required>
                        <small class="text-muted">Example: Marketing benefits 38 students.</small>
                    </div>

                </div>

                <hr>

                <h5>Budget Constraint</h5>
                <p class="text-muted">
                    Enter the cost per unit for each activity and the total available budget.
                </p>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label>Activity 1 Cost Per Unit (RM)</label>
                        <input type="number" step="any" name="c1_x" class="form-control" placeholder="Example: 100" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Activity 2 Cost Per Unit (RM)</label>
                        <input type="number" step="any" name="c1_y" class="form-control" placeholder="Example: 80" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Total Budget Available (RM)</label>
                        <input type="number" step="any" name="c1_rhs" class="form-control" placeholder="Example: 1000" required>
                    </div>
                </div>

                <hr>

                <h5>Volunteer / Time Constraint</h5>
                <p class="text-muted">
                    Enter the volunteer hours needed and total volunteer hours available.
                </p>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label>Activity 1 Volunteer Hours</label>
                        <input type="number" step="any" name="c2_x" class="form-control" placeholder="Example: 2" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Activity 2 Volunteer Hours</label>
                        <input type="number" step="any" name="c2_y" class="form-control" placeholder="Example: 3" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Total Volunteer Hours</label>
                        <input type="number" step="any" name="c2_rhs" class="form-control" placeholder="Example: 40" required>
                    </div>
                </div>

                <hr>

                <h5>Activity Limit</h5>
                <p class="text-muted">
                    Enter the maximum total number of activities that can be organized.
                </p>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label>Activity 1 Count</label>
                        <input type="number" step="any" name="c3_x" class="form-control" value="1" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Activity 2 Count</label>
                        <input type="number" step="any" name="c3_y" class="form-control" value="1" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Maximum Total Activities</label>
                        <input type="number" step="any" name="c3_rhs" class="form-control" placeholder="Example: 20" required>
                    </div>
                </div>

                <hr>

                <button type="submit" class="btn btn-success">
                    Generate Recommendation
                </button>

                <a href="dashboard.php" class="btn btn-secondary">
                    Back
                </a>

            </form>

        </div>
    </div>
</div>

</body>
</html>
