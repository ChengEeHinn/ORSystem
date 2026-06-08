# ORSystem — Campus Event Budget Allocation System

A web-based Linear Programming Decision Support System built with PHP and MySQL. ORSystem helps student clubs and organizations decide how to allocate limited resources across two campus activities to achieve the highest total student benefit.

---

## Quick Start

1. Install [XAMPP](https://www.apachefriends.org/) and start **Apache** and **MySQL**.
2. Copy this project folder into `xampp/htdocs/` (rename it to `ORSystem` for a cleaner URL, or keep the original folder name).
3. Create database `orsystem_db` in phpMyAdmin and import `orsystem_db.sql`.
4. Open `http://localhost/ORSystem` (adjust the URL to match your folder name).
5. Register an account, log in, and run your first optimization from the dashboard.

---

## Table of Contents

- [Overview](#overview)
- [Features](#features)
- [Technologies Used](#technologies-used)
- [System Workflow](#system-workflow)
- [System Modules](#system-modules)
- [How the Solver Works](#how-the-solver-works)
- [System Limitations](#system-limitations)
- [Project Structure](#project-structure)
- [Database](#database)
- [Installation Guide](#installation-guide)
- [Configuration](#configuration)
- [Example Case Study](#example-case-study)
- [Troubleshooting](#troubleshooting)
- [Project Members](#project-members)
- [Course Information](#course-information)
- [License](#license)

---

## Overview

ORSystem is an Operational Research project that applies **Linear Programming (LP)** to a real campus planning problem: how should a student club split its budget, volunteer hours, and activity slots between two event options?

Users enter benefit scores and resource limits through a simple web form. The system calculates the optimal allocation automatically, displays a clear recommendation, and saves each run to the database for later review.

**Current optimization mode:** Maximize total benefit *(the solver supports minimize in code, but the input form is set to maximize only)*.

---

## Features

- User registration and login with secure password hashing
- Session-based authentication
- Dashboard for quick access to all main functions
- Two-activity budget allocation using Linear Programming
- Automatic optimal solution calculation
- Result page with activity quantities, total benefit, and resource usage summary
- Plain-language recommendation interpretation
- Per-user optimization history with view and delete options
- MySQL database storage for users and LP problems
- Clean Bootstrap 5 interface

---

## Technologies Used

| Category | Technology |
|----------|------------|
| Backend | PHP |
| Database | MySQL / MariaDB |
| Frontend | HTML5, CSS3, Bootstrap 5.3.3 |
| Local Server | XAMPP (Apache + MySQL) |
| Database Tool | phpMyAdmin |

**Recommended environment:** PHP 8.x, MariaDB 10.4+ (based on project development setup).

---

## System Workflow

```
Home Page → Register / Login → Dashboard → Input Form → Solve → Result → History
```

| Step | Page | Description |
|------|------|-------------|
| 1 | `index.php` | View project information |
| 2 | `register.php` / `login.php` | Create account or sign in |
| 3 | `dashboard.php` | Main menu after login |
| 4 | `input.php` | Enter project title, benefits, and constraints |
| 5 | `solve.php` | Process LP model and save result |
| 6 | `result.php` | View recommended allocation and resource usage |
| 7 | `history.php` | Browse, reopen, or delete past records |

---

## System Modules

### Home Page (`index.php`)

Landing page with project overview, feature summary, and links to login or registration.

### User Authentication

- **Register** — create account with full name, email, and password
- **Login** — sign in with email and password
- **Logout** — end session securely

Passwords are stored using PHP `password_hash()` and verified with `password_verify()`.

### Dashboard (`dashboard.php`)

Central hub after login. Provides access to:

- **New Optimization** — open the input form
- **View History** — browse saved records
- **Latest Result** — opens the most recent result when accessed from a completed run; otherwise redirects to history
- **Logout**

### Budget Allocation Input (`input.php`)

Users enter:

| Section | Fields | Purpose |
|---------|--------|---------|
| Project info | Event / project title | Name the optimization run |
| Activity benefit | Benefit score for Activity 1 (X) and Activity 2 (Y) | Students reached per unit of each activity |
| Budget constraint | Cost per unit (RM) and total budget (RM) | `c1_x·X + c1_y·Y ≤ budget` |
| Volunteer constraint | Hours per unit and total hours available | `c2_x·X + c2_y·Y ≤ hours` |
| Activity limit | Count weights and maximum total activities | `c3_x·X + c3_y·Y ≤ limit` |

The system then calculates the best combination of Activity 1 and Activity 2 quantities.

### Result Module (`result.php`)

Displays:

- Recommended quantity for each activity
- Benefit per unit and total benefit per activity
- Maximum total benefit (objective value)
- Resource usage summary (budget and volunteer hours — available, used, remaining)
- System interpretation in plain language

### History Module (`history.php`)

- Lists all optimization records for the logged-in user
- **View Result** — reopen a past recommendation
- **Delete** — remove a record (with confirmation)

Each user can only access their own records.

---

## How the Solver Works

ORSystem uses the **corner-point method** (graphical LP approach) for a **two-variable** problem:

1. Collect candidate points from constraint line intersections and axis intercepts
2. Keep only **feasible** points where `X ≥ 0`, `Y ≥ 0`, and all three constraints are satisfied
3. Evaluate the objective function `Z = profit_x·X + profit_y·Y` at each feasible point
4. Select the point that gives the **maximum** total benefit

This method is suitable for small 2D LP problems and aligns with standard Operational Research teaching for graphical solution methods.

---

## System Limitations

Please note the following design boundaries:

- Supports **exactly 2 decision variables** (Activity 1 = X, Activity 2 = Y)
- Supports **exactly 3 linear constraints** plus non-negativity (`X, Y ≥ 0`)
- Input form is fixed to **Maximize** total benefit
- Assumes a **linear** relationship between activities and resources
- If no feasible solution is found, the system returns `(0, 0)` with objective value `0`

These limits keep the system simple for academic demonstration. Future versions could extend to more variables, the simplex method, or a dynamic constraint builder.

---

## Project Structure

```
ORSystem/
├── index.php        # Landing page
├── register.php     # User registration
├── login.php        # User login
├── logout.php       # Session logout
├── dashboard.php    # Main dashboard after login
├── input.php        # LP problem input form
├── solve.php        # LP solver and database save
├── result.php       # Optimization result display
├── history.php      # Record history (view / delete)
├── db.php           # Database connection settings
├── orsystem_db.sql  # Database schema and sample data
└── README.md        # Project documentation
```

---

## Database

**Database name:** `orsystem_db`

### Tables

| Table | Purpose |
|-------|---------|
| `users` | Stores user accounts (`full_name`, `email`, hashed `password`) |
| `lp_problems` | Stores each optimization run, input values, and optimal results |

### Relationship

- `lp_problems.user_id` references `users.id`
- Deleting a user removes their related LP records (`ON DELETE CASCADE`)

### Setup

Import `orsystem_db.sql` through phpMyAdmin **after** creating the `orsystem_db` database.

---

## Installation Guide

### Step 1 — Install XAMPP

Download and install XAMPP from [apachefriends.org](https://www.apachefriends.org/).

### Step 2 — Start Services

Open the XAMPP Control Panel and start:

- **Apache**
- **MySQL**

### Step 3 — Copy Project Files

Copy the entire project folder into:

```text
C:\xampp\htdocs\
```

**Tip:** Renaming the folder to `ORSystem` makes the URL shorter:

```text
C:\xampp\htdocs\ORSystem
```

### Step 4 — Open phpMyAdmin

Visit:

```text
http://localhost/phpmyadmin
```

### Step 5 — Create the Database

Create a new database named:

```sql
orsystem_db
```

### Step 6 — Import SQL File

1. Select the `orsystem_db` database
2. Go to the **Import** tab
3. Choose `orsystem_db.sql` from the project folder
4. Click **Go**

### Step 7 — Open the System

If your folder is named `ORSystem`:

```text
http://localhost/ORSystem
```

If you kept the original download name, use that folder name instead:

```text
http://localhost/ORSystem-main
```

### Step 8 — Register and Login

1. Click **Register** and create a new account
2. Log in with your email and password
3. From the dashboard, click **New Optimization** to begin

---

## Configuration

Database settings are in `db.php`:

| Setting | Default (XAMPP) |
|---------|-----------------|
| Host | `localhost` |
| Username | `root` |
| Password | *(empty)* |
| Database | `orsystem_db` |

If your MySQL username or password is different, update `db.php` before running the system.

---

## Example Case Study

**Scenario:** Campus Event Budget Allocation

A student club wants to choose how many units of two activities to run:

- **Activity 1 (X)** — e.g. Catering
- **Activity 2 (Y)** — e.g. Marketing

### Objective

Maximize total students reached:

```text
Maximize Z = 50X + 38Y
```

| Variable | Benefit per unit | Meaning |
|----------|------------------|---------|
| X | 50 | 50 students benefit per catering unit |
| Y | 38 | 38 students benefit per marketing unit |

### Constraints

| Constraint | Formula | Meaning |
|------------|---------|---------|
| Budget | `100X + 80Y ≤ 1000` | RM cost limits (RM 100/unit for X, RM 80/unit for Y) |
| Volunteer hours | `2X + 3Y ≤ 40` | Total volunteer hours available |
| Activity limit | `X + Y ≤ 20` | Maximum total activities allowed |

### Input Values (matches the web form)

| Field | Value |
|-------|-------|
| Project title | Campus Event Budget Allocation Demo |
| Activity 1 benefit | 50 |
| Activity 2 benefit | 38 |
| Activity 1 cost (RM) | 100 |
| Activity 2 cost (RM) | 80 |
| Total budget (RM) | 1000 |
| Activity 1 volunteer hours | 2 |
| Activity 2 volunteer hours | 3 |
| Total volunteer hours | 40 |
| Activity 1 count weight | 1 |
| Activity 2 count weight | 1 |
| Maximum total activities | 20 |

### Optimal Result

```text
Activity 1 (X) = 10
Activity 2 (Y) = 0
Maximum Total Benefit = 500
```

### Resource Usage

| Resource | Available | Used | Remaining |
|----------|-----------|------|-----------|
| Budget (RM) | 1000 | 1000.00 | 0.00 |
| Volunteer hours | 40 | 20.00 | 20.00 |

**Interpretation:** Run 10 units of Activity 1 and 0 units of Activity 2. This uses the full budget, stays within volunteer and activity limits, and maximizes total student benefit at 500.

---

## Troubleshooting

| Problem | Possible Solution |
|---------|-------------------|
| Page not found | Check folder name under `htdocs/` and match it in the URL |
| Database connection failed | Confirm MySQL is running in XAMPP; verify settings in `db.php` |
| Blank or error page | Ensure Apache is running; check XAMPP error logs |
| Import failed | Create `orsystem_db` first, then import `orsystem_db.sql` into that database |
| Cannot register / login | Confirm the `users` table exists and was imported successfully |
| Apache will not start | Another app may be using port 80 — change Apache port in XAMPP or stop the conflicting service |

---

## Project Members

| No. | Name | Matric Number |
|-----|------|---------------|
| 1 | Lim Xin Yi | 2240250 |
| 2 | Nurul Hidayah Binti Faran | 2240251 |
| 3 | Ahmad Thaqif Bin Badrul Hisyam | 2240231 |
| 4 | Cheng Ee Hinn | 2240233 |

---

## Course Information

| Item | Details |
|------|---------|
| Course | Operational Research |
| Project Title | Campus Event Budget Allocation System |
| Academic Year | 2025/2026 |

---

## License

This project was developed for academic and educational purposes.
