<?php
session_start();
include("db.php");

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: input.php");
    exit();
}

$user_id = $_SESSION["user_id"];

$project_title = mysqli_real_escape_string($conn, $_POST["project_title"]);
$objective_type = mysqli_real_escape_string($conn, $_POST["objective_type"]);

$profit_x = floatval($_POST["profit_x"]);
$profit_y = floatval($_POST["profit_y"]);

$c1_x = floatval($_POST["c1_x"]);
$c1_y = floatval($_POST["c1_y"]);
$c1_rhs = floatval($_POST["c1_rhs"]);

$c2_x = floatval($_POST["c2_x"]);
$c2_y = floatval($_POST["c2_y"]);
$c2_rhs = floatval($_POST["c2_rhs"]);

$c3_x = floatval($_POST["c3_x"]);
$c3_y = floatval($_POST["c3_y"]);
$c3_rhs = floatval($_POST["c3_rhs"]);

function intersection($a1, $b1, $c1, $a2, $b2, $c2)
{
    $det = ($a1 * $b2) - ($a2 * $b1);

    if (abs($det) < 0.000001) {
        return null;
    }

    $x = (($c1 * $b2) - ($c2 * $b1)) / $det;
    $y = (($a1 * $c2) - ($a2 * $c1)) / $det;

    return [$x, $y];
}

function feasible(
    $x,
    $y,
    $c1_x, $c1_y, $c1_rhs,
    $c2_x, $c2_y, $c2_rhs,
    $c3_x, $c3_y, $c3_rhs
)
{
    if ($x < -0.0001 || $y < -0.0001) {
        return false;
    }

    if (($c1_x * $x + $c1_y * $y) > $c1_rhs + 0.0001) {
        return false;
    }

    if (($c2_x * $x + $c2_y * $y) > $c2_rhs + 0.0001) {
        return false;
    }

    if (($c3_x * $x + $c3_y * $y) > $c3_rhs + 0.0001) {
        return false;
    }

    return true;
}

$points = [];

$points[] = [0, 0];

$p = intersection($c1_x, $c1_y, $c1_rhs, $c2_x, $c2_y, $c2_rhs);
if ($p) $points[] = $p;

$p = intersection($c1_x, $c1_y, $c1_rhs, $c3_x, $c3_y, $c3_rhs);
if ($p) $points[] = $p;

$p = intersection($c2_x, $c2_y, $c2_rhs, $c3_x, $c3_y, $c3_rhs);
if ($p) $points[] = $p;

if ($c1_y != 0) $points[] = [0, $c1_rhs / $c1_y];
if ($c2_y != 0) $points[] = [0, $c2_rhs / $c2_y];
if ($c3_y != 0) $points[] = [0, $c3_rhs / $c3_y];

if ($c1_x != 0) $points[] = [$c1_rhs / $c1_x, 0];
if ($c2_x != 0) $points[] = [$c2_rhs / $c2_x, 0];
if ($c3_x != 0) $points[] = [$c3_rhs / $c3_x, 0];

$bestPoint = null;
$bestValue = null;

foreach ($points as $point) {

    $x = $point[0];
    $y = $point[1];

    if (!feasible(
        $x, $y,
        $c1_x, $c1_y, $c1_rhs,
        $c2_x, $c2_y, $c2_rhs,
        $c3_x, $c3_y, $c3_rhs
    )) {
        continue;
    }

    $z = ($profit_x * $x) + ($profit_y * $y);

    if ($bestPoint === null) {
        $bestPoint = [$x, $y];
        $bestValue = $z;
    } else {
        if ($objective_type == "Maximize") {
            if ($z > $bestValue) {
                $bestValue = $z;
                $bestPoint = [$x, $y];
            }
        } else {
            if ($z < $bestValue) {
                $bestValue = $z;
                $bestPoint = [$x, $y];
            }
        }
    }
}

if ($bestPoint === null) {
    $optimal_x = 0;
    $optimal_y = 0;
    $bestValue = 0;
} else {
    $optimal_x = round($bestPoint[0], 4);
    $optimal_y = round($bestPoint[1], 4);
    $bestValue = round($bestValue, 4);
}

$sql = "INSERT INTO lp_problems (
    user_id,
    project_title,
    objective_type,
    profit_x,
    profit_y,
    c1_x,
    c1_y,
    c1_rhs,
    c2_x,
    c2_y,
    c2_rhs,
    c3_x,
    c3_y,
    c3_rhs,
    optimal_x,
    optimal_y,
    objective_value
)
VALUES (
    '$user_id',
    '$project_title',
    '$objective_type',
    '$profit_x',
    '$profit_y',
    '$c1_x',
    '$c1_y',
    '$c1_rhs',
    '$c2_x',
    '$c2_y',
    '$c2_rhs',
    '$c3_x',
    '$c3_y',
    '$c3_rhs',
    '$optimal_x',
    '$optimal_y',
    '$bestValue'
)";

if (mysqli_query($conn, $sql)) {
    $problem_id = mysqli_insert_id($conn);
    header("Location: result.php?id=" . $problem_id);
    exit();
} else {
    die("Database insert failed: " . mysqli_error($conn));
}
?>
