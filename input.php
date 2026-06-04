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
    <title>New Optimization - ORSystem</title>

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
                <strong>LP Model:</strong> Z = aX + bY<br>
                X = Activity 1, Y = Activity 2
            </div>

            <form action="solve.php" method="POST">

                <div class="mb-3">
                    <label class="form-label">Project Title</label>
                    <input type="text"
                           name="project_title"
                           class="form-control"
                           placeholder="Example: Campus Sports Day Budget Allocation"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Objective Type</label>
                    <select name="objective_type" class="form-control" required>
                        <option value="Maximize">Maximize</option>
                        <option value="Minimize">Minimize</option>
                    </select>
                </div>

                <hr>

                <h5>Objective Function</h5>
                <p class="text-muted">
                    Example: Maximize Z = 50X + 40Y
                </p>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Coefficient of X</label>
                        <input type="number"
                               step="any"
                               name="profit_x"
                               class="form-control"
                               placeholder="Example: 50"
                               required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Coefficient of Y</label>
                        <input type="number"
                               step="any"
                               name="profit_y"
                               class="form-control"
                               placeholder="Example: 40"
                               required>
                    </div>
                </div>

                <hr>

                <h5>Constraint 1</h5>
                <p class="text-muted">
                    Example: 100X + 80Y ≤ 1000
                </p>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <input type="number" step="any" name="c1_x" class="form-control" placeholder="X Coefficient" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <input type="number" step="any" name="c1_y" class="form-control" placeholder="Y Coefficient" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <input type="number" step="any" name="c1_rhs" class="form-control" placeholder="Right Hand Side" required>
                    </div>
                </div>

                <h5>Constraint 2</h5>
                <p class="text-muted">
                    Example: 2X + 3Y ≤ 40
                </p>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <input type="number" step="any" name="c2_x" class="form-control" placeholder="X Coefficient" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <input type="number" step="any" name="c2_y" class="form-control" placeholder="Y Coefficient" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <input type="number" step="any" name="c2_rhs" class="form-control" placeholder="Right Hand Side" required>
                    </div>
                </div>

                <h5>Constraint 3</h5>
                <p class="text-muted">
                    Example: X + Y ≤ 20
                </p>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <input type="number" step="any" name="c3_x" class="form-control" placeholder="X Coefficient" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <input type="number" step="any" name="c3_y" class="form-control" placeholder="Y Coefficient" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <input type="number" step="any" name="c3_rhs" class="form-control" placeholder="Right Hand Side" required>
                    </div>
                </div>

                <hr>

                <button type="submit" class="btn btn-success">
                    Solve Problem
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
