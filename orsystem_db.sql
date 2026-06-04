DROP DATABASE IF EXISTS orsystem_db;
CREATE DATABASE orsystem_db;
USE orsystem_db;

CREATE TABLE users (
    id INT(11) NOT NULL AUTO_INCREMENT,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY email (email)
);

CREATE TABLE lp_problems (
    id INT(11) NOT NULL AUTO_INCREMENT,
    user_id INT(11) NOT NULL,
    project_title VARCHAR(255) NOT NULL,
    objective_type ENUM('Maximize','Minimize') NOT NULL,
    profit_x DOUBLE NOT NULL,
    profit_y DOUBLE NOT NULL,
    c1_x DOUBLE NOT NULL,
    c1_y DOUBLE NOT NULL,
    c1_rhs DOUBLE NOT NULL,
    c2_x DOUBLE NOT NULL,
    c2_y DOUBLE NOT NULL,
    c2_rhs DOUBLE NOT NULL,
    c3_x DOUBLE NOT NULL,
    c3_y DOUBLE NOT NULL,
    c3_rhs DOUBLE NOT NULL,
    optimal_x DOUBLE DEFAULT NULL,
    optimal_y DOUBLE DEFAULT NULL,
    objective_value DOUBLE DEFAULT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    CONSTRAINT fk_user
    FOREIGN KEY (user_id) REFERENCES users(id)
    ON DELETE CASCADE
);

INSERT INTO users (
    id,
    full_name,
    email,
    password
)
VALUES (
    1,
    'Lim Xin Yi',
    'limxinyi04@gmail.com',
    '123456'
);

INSERT INTO lp_problems (
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
    1,
    'Campus Event Budget Allocation Demo',
    'Maximize',
    50,
    38,
    100,
    80,
    1000,
    2,
    3,
    40,
    1,
    1,
    20,
    10,
    0,
    500
);
