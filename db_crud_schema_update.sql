-- Create tbl_municipalities table
CREATE TABLE tbl_municipalities (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);

-- Create tbl_barangay table
CREATE TABLE tbl_barangay (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    muni_id INT,
    FOREIGN KEY (muni_id) REFERENCES tbl_municipalities(id)
);

-- Modify tbl_users table
ALTER TABLE tbl_users 
MODIFY COLUMN email VARCHAR(100) NOT NULL, 
ADD CONSTRAINT unique_email UNIQUE (email),
ADD COLUMN password VARCHAR(255) NOT NULL,
ADD COLUMN created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
ADD COLUMN brgy_id INT,
ADD CONSTRAINT fk_users_barangay FOREIGN KEY (brgy_id) REFERENCES tbl_barangay(id);

-- Insert Record for the Address
INSERT INTO tbl_municipalities (id, name) VALUES (1, 'Kalibo');
INSERT INTO tbl_municipalities (id, name) VALUES (2, 'Banga');
INSERT INTO tbl_barangay(name, muni_id) VALUES ('Poblacion', 1);
INSERT INTO tbl_barangay(name, muni_id) VALUES ('Andagao', 1);
INSERT INTO tbl_barangay(name, muni_id) VALUES ('Linabuan Sur', 2);


