mysql> CREATE DATABASE IF NOT EXISTS wallet_app CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
Query OK, 1 row affected (0.03 sec)

mysql> USE wallet_app;
Database changed

mysql> CREATE TABLE users (
    ->     id INT AUTO_INCREMENT PRIMARY KEY,
    ->     name VARCHAR(100) NOT NULL,
    ->     email VARCHAR(150) NOT NULL UNIQUE,
    ->     password VARCHAR(255) NOT NULL,
    ->     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    -> );
Query OK, 0 rows affected (0.07 sec)

mysql> CREATE TABLE wallets (
    ->     id INT AUTO_INCREMENT PRIMARY KEY,
    ->     user_id INT NOT NULL,
    ->     month_year CHAR(7) NOT NULL,  -- Example: "2026-01"
    ->     balance DECIMAL(10,2) DEFAULT 0,
    ->     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ->     FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    ->     UNIQUE(user_id, month_year)
    -> );
Query OK, 0 rows affected (0.08 sec)

mysql> CREATE TABLE categories (
    ->     id INT AUTO_INCREMENT PRIMARY KEY,
    ->     user_id INT NULL,  -- NULL = global category
    ->     name VARCHAR(100) NOT NULL,
    ->     icon VARCHAR(50) NULL,
    ->     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ->     FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
    -> );
Query OK, 0 rows affected (0.10 sec)


mysql> CREATE TABLE budgets (
    ->     id INT AUTO_INCREMENT PRIMARY KEY,
    ->     user_id INT NOT NULL,
    ->     month_year CHAR(7) NOT NULL,
    ->     amount DECIMAL(10,2) NOT NULL,
    ->     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ->     UNIQUE(user_id, month_year),
    ->     FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    -> );
Query OK, 0 rows affected (0.12 sec)


mysql> CREATE TABLE expenses (
    ->     id INT AUTO_INCREMENT PRIMARY KEY,
    ->     user_id INT NOT NULL,
    ->     category_id INT NOT NULL,
    ->     wallet_id INT NOT NULL,
    ->     title VARCHAR(150) NOT NULL,
    ->     amount DECIMAL(10,2) NOT NULL,
    ->     expense_date DATE NOT NULL,
    ->     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ->     FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    ->     FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL,
    ->     FOREIGN KEY (wallet_id) REFERENCES wallets(id) ON DELETE CASCADE
    -> );
ERROR 1830 (HY000): Column 'category_id' cannot be NOT NULL: needed in a foreign key constraint 'expenses_ibfk_2' SET NULL

mysql> CREATE TABLE automatic_expenses (
    ->     id INT AUTO_INCREMENT PRIMARY KEY,
    ->     user_id INT NOT NULL,
    ->     category_id INT NOT NULL,
    ->     title VARCHAR(150) NOT NULL,
    ->     amount DECIMAL(10,2) NOT NULL,
    ->     repeat_day TINYINT NOT NULL, -- Example: 5 (5th of every month)
    ->     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ->     
    ->     FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    ->     FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL
    -> );
ERROR 1830 (HY000): Column 'category_id' cannot be NOT NULL: needed in a foreign key constraint 'automatic_expenses_ibfk_2' SET NULL

mysql> INSERT INTO categories (name, user_id) VALUES
    -> ('Food', NULL),
    -> ('Transportation', NULL),
    -> ('Shopping', NULL),
    -> ('Bills', NULL),
    -> ('Health', NULL),
    -> ('Subscriptions', NULL),
    -> ('Education', NULL);
Query OK, 7 rows affected (0.01 sec)
Records: 7  Duplicates: 0  Warnings: 0

mysql> no tee ;
ERROR 1064 (42000): You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'no tee' at line 1
mysql> notee ;
