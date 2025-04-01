# CRUD Login and Registration System

This project is a simple CRUD-based login and registration system using PHP and MySQL. It allows users to register, log in, update their profile, and manage their credentials securely.

## Features
- User registration with email validation
- Secure password storage using hashing
- User login with authentication
- Profile update functionality
- Database integration with MySQL

## Database Setup
The system uses the following tables:

### 1️⃣ `tbl_users`
Stores user details.
```sql
ALTER TABLE tbl_users 
MODIFY COLUMN email VARCHAR(100) NOT NULL, 
ADD CONSTRAINT unique_email UNIQUE (email),
ADD COLUMN password VARCHAR(255) NOT NULL,
ADD COLUMN created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
ADD COLUMN brgy_id INT,
ADD CONSTRAINT fk_users_barangay FOREIGN KEY (brgy_id) REFERENCES tbl_barangay(id);
```

### 2️⃣ `tbl_municipalities`
Stores municipalities.
```sql
CREATE TABLE tbl_municipalities (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);
```

### 3️⃣ `tbl_barangay`
Stores barangays with a reference to municipalities.
```sql
CREATE TABLE tbl_barangay (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    muni_id INT,
    FOREIGN KEY (muni_id) REFERENCES tbl_municipalities(id)
);
```

## Installation
1. Clone the repository:
   ```sh
   git clone https://github.com/your-username/crud-auth.git
   ```
2. Navigate to the project folder:
   ```sh
   cd crud-auth
   ```
3. Import the `db_crud_setup.sql` file into MySQL.
4. Configure database credentials in `config.php`:
   ```php
   $host = 'localhost';
   $user = 'root';
   $password = '';
   $database = 'db_crud';
   ```
5. Start your local server and access the project in your browser:
   ```
   http://localhost/crud-auth/
   ```

## Usage
- Users can **register** using their email and password.
- Upon registration, users can **log in** and access their profile.
- Users can **update** their profile information, including barangay selection.

## License
This project is open-source and available under the [MIT License](LICENSE).

