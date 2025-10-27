-- dynamic_project.sql
DROP DATABASE IF EXISTS dynamic_project;
CREATE DATABASE dynamic_project CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE dynamic_project;

CREATE TABLE contacts (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(120) NOT NULL,
  email VARCHAR(180) NOT NULL UNIQUE,
  phone VARCHAR(30) DEFAULT NULL,
  dob DATE DEFAULT NULL,
  notes TEXT DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- sample data
INSERT INTO contacts (name, email, phone, dob, notes) VALUES
('Aron Binu Mathew', 'aronbinumathew.b22cs1114@mbcet.ac.in', '+91-9876543210', '2004-06-30', 'Computer Engineering student'),
('Issac Joshy', 'issacjoshy@gmail.com', '+1-555-1234', '2004-01-01', 'Sample contact'),
('Shaun George', 'shaungeorge@yahoo.com', NULL, NULL, 'Another sample');
