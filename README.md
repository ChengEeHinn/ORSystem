# ORSystem - Campus Event Budget Allocation System

## Project Overview

ORSystem is a web-based Decision Support System developed using PHP and MySQL. The system helps student clubs and organizations allocate budgets efficiently for campus activities using Linear Programming optimization techniques.

Users can enter activity benefits, costs, and constraints, and the system will generate the optimal allocation that maximizes total benefit while satisfying resource limitations.

---

## Features

* User Registration and Login
* Secure Password Hashing
* Budget Allocation Optimization
* Linear Programming Calculation
* Result Interpretation
* Optimization History Storage
* MySQL Database Integration
* Responsive Bootstrap Interface

---

## Technologies Used

* PHP
* MySQL
* Bootstrap 5
* HTML5
* CSS3
* XAMPP
* phpMyAdmin

---

## System Modules

### Home Page

Provides information about the system and project overview.

### User Authentication

* Register Account
* Login Account
* Logout Session

### Budget Allocation Module

Users enter:

* Project Title
* Activity Benefit Values
* Budget Constraints
* Resource Constraints

The system calculates the optimal solution automatically.

### Result Module

Displays:

* Optimal Activity Quantities
* Total Benefit
* Resource Usage Summary
* Recommendation Interpretation

### History Module

Stores and displays previous optimization records.

---

## Database

Database Name:

```sql
orsystem_db
```

Tables:

1. users
2. lp_problems

Import:

```text
orsystem_db.sql
```

using phpMyAdmin before running the system.

---

## Installation Guide

### Step 1

Install XAMPP.

### Step 2

Start:

* Apache
* MySQL

### Step 3

Copy project folder into:

```text
xampp/htdocs/
```

### Step 4

Open phpMyAdmin:

```text
http://localhost/phpmyadmin
```

### Step 5

Create database:

```sql
orsystem_db
```

### Step 6

Import:

```text
orsystem_db.sql
```

### Step 7

Open system:

```text
http://localhost/ORSystem
```

### Step 8

Register a new account and login.

---

## Example Case Study

Campus Event Budget Allocation

Objective Function:

```text
Maximize Z = 50X + 38Y
```

Where:

* X = Activity 1
* Y = Activity 2

Constraints:

```text
100X + 80Y ≤ 1000
2X + 3Y ≤ 40
X + Y ≤ 20
```

Result:

```text
Activity 1 = 10
Activity 2 = 0
Maximum Benefit = 500
```

---

## Project Members

1. Lim Xin Yi
2. Nurul Hidayah
3. Ahmad Thaqif
4. Cheng Ee Hinn

---

## Course Information

Course: Operational Research

Project Title:

Campus Event Budget Allocation System

Academic Year: 2025/2026

---

## License

This project was developed for academic and educational purposes.
