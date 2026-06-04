CREATE TABLE events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    event_name VARCHAR(100),
    event_date DATE
);

CREATE TABLE registrations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    event_id INT,
    student_name VARCHAR(100)
);

INSERT INTO events (event_name, event_date) VALUES
('Tech Fest', '2026-02-10'),
('Cultural Day', '2026-03-05'),
('Sports Meet', '2026-04-01');

INSERT INTO registrations (event_id, student_name) VALUES
(1, 'Amit'),
(1, 'Sneha'),
(2, 'Riya'),
(3, 'Rahul');
