CREATE TABLE faculty (id INT(11) NOT NULL AUTO_INCREMENT , faculty_name VARCHAR(250) NOT NULL, PRIMARY KEY (id));
CREATE TABLE student (id INT(11) NOT NULL AUTO_INCREMENT,
                      faculty_id INT(11) NOT NULL,
                      name VARCHAR(250) NOT NULL, 
                      phone VARCHAR(15) NOT NULL, 
                      PRIMARY KEY (id),
                      FOREIGN KEY (faculty_id) REFERENCES faculty(id));

INSERT INTO faculty (id, faculty_name) VALUES (NULL, "Civil Engineering");
INSERT INTO faculty (id, faculty_name) VALUES (NULL, "Software Engineering");
INSERT INTO faculty (id, faculty_name) VALUES (NULL, "Law");
INSERT INTO faculty (id, faculty_name) VALUES (NULL, "Psychology");
INSERT INTO faculty (id, faculty_name) VALUES (NULL, "Economic");

INSERT INTO student (id, name, phone, faculty_id) VALUES (NULL, "Andreas Smith", "+6283123123", 1);
INSERT INTO student (id, name, phone, faculty_id) VALUES (NULL, "Ah young Park", "+6283123123", 4);
INSERT INTO student (id, name, phone, faculty_id) VALUES (NULL, "Heusthy Margaret", "+6283198023", 3);
INSERT INTO student (id, name, phone, faculty_id) VALUES (NULL, "Su Ryu Ang", "+6283123123", 3);

SELECT COUNT(*) as count FROM student JOIN faculty ON faculty.id = student.faculty_id WHERE faculty.faculty_name = "Law";

SELECT student.id, student.name, student.phone, faculty.faculty_name as faculty FROM student JOIN faculty ON faculty.id = student.faculty_id WHERE faculty.faculty_name = "Civil Engineering";
SELECT student.id, student.name, student.phone, faculty.faculty_name as faculty FROM student JOIN faculty ON faculty.id = student.faculty_id ORDER BY SUBSTRING_INDEX(name, ' ', -1) ASC;