<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ORSystem - Linear Programming Decision Support System</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f5f7fa;
            font-family: Arial, sans-serif;
        }

        .hero-section {
            background: linear-gradient(135deg, #0d6efd, #0a58ca);
            color: white;
            padding: 80px 20px;
            text-align: center;
        }

        .hero-section h1 {
            font-size: 60px;
            font-weight: bold;
        }

        .hero-section p {
            font-size: 20px;
        }

        .card-custom {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .section-title {
            font-weight: bold;
            margin-bottom: 20px;
        }

        footer {
            background-color: #212529;
            color: white;
            padding: 15px;
            text-align: center;
            margin-top: 50px;
        }

        .btn-custom {
            padding: 12px 25px;
            font-size: 18px;
            border-radius: 10px;
        }
    </style>
</head>
<body>

    <!-- HERO SECTION -->
    <div class="hero-section">
        <h1>ORSystem</h1>
        <p>Linear Programming Decision Support System</p>

        <a href="login.php" class="btn btn-light btn-custom me-2">
        Login
		</a>

		<a href="register.php" class="btn btn-outline-light btn-custom">
        Register
		</a>
    </div>

    <!-- PROJECT OVERVIEW -->
    <div class="container mt-5">

        <div class="card card-custom p-4 mb-4">
            <h2 class="section-title">Project Overview</h2>

            <p>
                ORSystem is a web-based Linear Programming Decision Support System
                developed using PHP and MySQL.
            </p>

            <p>
                This system helps users solve optimization problems such as
                product mix optimization, budget allocation, and production planning.
            </p>

            <p>
                Users can enter:
            </p>

            <ul>
                <li>Decision Variables</li>
                <li>Objective Function</li>
                <li>Constraints</li>
                <li>Optimization Type (Maximize / Minimize)</li>
            </ul>

            <p>
                The system will generate the optimal solution and display
                the best objective value.
            </p>
        </div>

        <!-- FEATURES -->
        <div class="card card-custom p-4 mb-4">
            <h2 class="section-title">System Features</h2>

            <div class="row text-center">

                <div class="col-md-3 mb-3">
                    <div class="border rounded p-3 h-100">
                        <h5>Input LP Model</h5>
                        <p>Enter objective function and constraints.</p>
                    </div>
                </div>

                <div class="col-md-3 mb-3">
                    <div class="border rounded p-3 h-100">
                        <h5>Optimization</h5>
                        <p>Generate optimal solution automatically.</p>
                    </div>
                </div>

                <div class="col-md-3 mb-3">
                    <div class="border rounded p-3 h-100">
                        <h5>Database Storage</h5>
                        <p>Store and retrieve LP problem data.</p>
                    </div>
                </div>

                <div class="col-md-3 mb-3">
                    <div class="border rounded p-3 h-100">
                        <h5>Result Display</h5>
                        <p>Display decision variables and objective value.</p>
                    </div>
                </div>

            </div>
        </div>

        <!-- TEAM MEMBERS -->
        <div class="card card-custom p-4 mb-4">
            <h2 class="section-title">Group Members</h2>

            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Matric Number</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>1</td>
                        <td>LIM XIN YI</td>
                        <td>22402xx</td>
                    </tr>

                    <tr>
                        <td>2</td>
                        <td>NURUL HIDAYAH BINTI XX</td>
                        <td>22402xx</td>
                    </tr>

                    <tr>
                        <td>3</td>
                        <td>AHMAD THAQIF BIN XX</td>
                        <td>22402xx</td>
                    </tr>

                    <tr>
                        <td>4</td>
                        <td>CHENG EE HINN</td>
                        <td>2240233</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

    <!-- FOOTER -->
    <footer>
        <p class="mb-0">
            ORSystem © 2026 | Operational Research Group 1 Project
        </p>
    </footer>

</body>
</html>