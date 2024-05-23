**************************Sites of icons**************************************
Websites for icons:
ikonate
evaicons
feather
remixicon
ion icons
icon svg
simple icons for company logos
material icon
line icons
lordicons for animated icons
thenounproject
flaticon
**************************Sites of icons**************************************

**************************SQL queries for itutor**************************************
CREATE TABLE Teacher (
    teacherid INT AUTO_INCREMENT PRIMARY KEY,
    fname VARCHAR(50) NOT NULL,
    mname VARCHAR(50),
    lname VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL, -- Store hashed and salted passwords
    address VARCHAR(255),
    profilePicture BLOB, -- Binary Large Object for profile pictures
    registrationDate DATE,
    DOB DATE,
    gender ENUM('Male', 'Female', 'Other'),
    age INT,
    country VARCHAR(50),
    experience TEXT,
    timezone VARCHAR(50),
    subject_id INT, -- Foreign key referencing the Subject table
    headline VARCHAR(255),
    description TEXT,
    videoLinks TEXT, -- Store video links as a JSON or structured data
    rates DECIMAL(10, 2), -- Decimal for monetary values
    FOREIGN KEY (subject_id) REFERENCES Subject(subject_id)
);

CREATE TABLE TeacherEducation (
    tedu_id INT AUTO_INCREMENT PRIMARY KEY,
    eduTitle VARCHAR(100),
    eduYear INT,
    institute VARCHAR(100),
    teacherid INT,
    FOREIGN KEY (teacherid) REFERENCES Teacher(teacherid)
);

CREATE TABLE TeacherCertification (
    tcert_id INT AUTO_INCREMENT PRIMARY KEY,
    certTitle VARCHAR(100),
    certStartYear INT,
    certEndYear INT,
    certLink VARCHAR(255),
    teacherid INT,
    FOREIGN KEY (teacherid) REFERENCES Teacher(teacherid)
);

CREATE TABLE Language (
    languageid INT AUTO_INCREMENT PRIMARY KEY,
    language VARCHAR(50),
    teacherid INT,
    FOREIGN KEY (teacherid) REFERENCES Teacher(teacherid)
);

CREATE TABLE Subject (
    subjectid INT AUTO_INCREMENT PRIMARY KEY,
    subjectName VARCHAR(100) NOT NULL
);

ALTER TABLE Teacher
ADD teacherintro TEXT;

-- Add the "issued_by" and "subjectid" columns to the TeacherCertification table
ALTER TABLE TeacherCertification
ADD issued_by VARCHAR(100),
ADD subjectid INT;

-- Create foreign keys for the "teacherid" and "subjectid" columns
ALTER TABLE TeacherCertification
ADD FOREIGN KEY (teacherid) REFERENCES Teacher(teacherid),
ADD FOREIGN KEY (subjectid) REFERENCES Subject(subjectid);

CREATE TABLE TeacherAvailability (
    TeacherID INT,
    DayOfWeek ENUM('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'),
    Availability JSON, -- You can use JSON to store an array of time slots
    CONSTRAINT pk_teacher_day PRIMARY KEY (TeacherID, DayOfWeek),
    FOREIGN KEY (TeacherID) REFERENCES Teacher(TeacherID)
);





CREATE TABLE Student (
    studentid INT AUTO_INCREMENT PRIMARY KEY,
    fname VARCHAR(50) NOT NULL,
    lname VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    profilePic BLOB,
    registrationDate DATE,
    accountStatus BOOLEAN,
    gender ENUM('Male', 'Female', 'Other'),
    DOB DATE,
    country VARCHAR(50),
    timezone VARCHAR(50)
);
ALTER TABLE Student
ADD mname VARCHAR(50) NULL;



CREATE TABLE Admin (
    adminid INT AUTO_INCREMENT PRIMARY KEY,
    fname VARCHAR(50) NOT NULL,
    lname VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    profilePic BLOB,
    registrationDate DATE,
    accountStatus BOOLEAN,
    gender ENUM('Male', 'Female', 'Other')
);

CREATE TABLE files (
    file_id INT AUTO_INCREMENT PRIMARY KEY,
    filename VARCHAR(255) NOT NULL,
    path VARCHAR(255) NOT NULL,
    type VARCHAR(50) NOT NULL,
    size INT NOT NULL,
    uploaded_by INT, -- Assuming this is the ID of the teacher who uploaded the file
    uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (uploaded_by) REFERENCES Teacher(teacherid) -- Reference to the teacher who uploaded the file
);
ALTER TABLE files
ADD uploaded_for INT,
ADD FOREIGN KEY (uploaded_for) REFERENCES Student(studentid);


CREATE TABLE Lessons (
    lessonid INT AUTO_INCREMENT PRIMARY KEY,
    subjectid VARCHAR(100),
    lessonDateTime DATETIME,
    duration INT, -- In minutes
    price DECIMAL(10, 2), -- Decimal for monetary values
    lessonStatus ENUM('Scheduled', 'Completed', 'Canceled', 'Pending', 'Other'),
    teacherid INT,
    studentid INT,
    FOREIGN KEY (teacherid) REFERENCES teacher(teacherid),
    FOREIGN KEY (studentid) REFERENCES student(studentid),
    FOREIGN KEY (subjectid) REFERENCES subject(subjectid)
);

CREATE TABLE Reviews (
    ReviewID INT AUTO_INCREMENT PRIMARY KEY,
    Rating INT, -- You can define a scale for ratings
    Comment TEXT,
    Reviewer INT, -- UserID of the student who left the review
    Reviewed INT,
    FOREIGN KEY (LessonID) REFERENCES lessons(lessonid),
    FOREIGN KEY (Reviewer) REFERENCES student(studentid),
    FOREIGN KEY (Reviewed) REFERENCES teacher(teacherid)
);

CREATE TABLE Transactions (
    transactionid INT AUTO_INCREMENT PRIMARY KEY,
    PaymentAmount DECIMAL(10, 2), -- Decimal for monetary values
    PaymentStatus ENUM('Success', 'Pending', 'Failed'),
    TransactionDate DATETIME,
    lessonid INT,
    FOREIGN KEY (lessonid) REFERENCES Lessons(lessonid)
);


CREATE TABLE Message (
    messageid INT AUTO_INCREMENT PRIMARY KEY,
    senderemail VARCHAR(100) NOT NULL UNIQUE,
    receiveremail VARCHAR(100) NOT NULL UNIQUE,
    messageText TEXT,
    timestamp DATETIME,
    FOREIGN KEY (senderemail) REFERENCES alluser(email), -- Assuming "Users" is a common table for all user types
    FOREIGN KEY (receiveremail) REFERENCES alluser(email)
);


CREATE TABLE alluser (
    userid INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL UNIQUE
);

-- Insert distinct email addresses from Student table
INSERT INTO alluser (email)
SELECT DISTINCT email FROM Student;

-- Insert distinct email addresses from Teacher table
INSERT INTO alluser (email)
SELECT DISTINCT email FROM Teacher;

-- Insert distinct email addresses from Admin table
INSERT INTO alluser (email)
SELECT DISTINCT email FROM Admin;




-- Create an AFTER INSERT trigger for the Student table
DELIMITER $$
CREATE TRIGGER Student_AfterInsert
AFTER INSERT ON Student
FOR EACH ROW
BEGIN
    INSERT INTO alluser (email) VALUES (NEW.email);
END;
$$
DELIMITER ;

-- Create an AFTER INSERT trigger for the Teacher table
DELIMITER $$
CREATE TRIGGER Teacher_AfterInsert
AFTER INSERT ON Teacher
FOR EACH ROW
BEGIN
    INSERT INTO alluser (email) VALUES (NEW.email);
END;
$$
DELIMITER ;

-- Create an AFTER INSERT trigger for the Admin table
DELIMITER $$
CREATE TRIGGER Admin_AfterInsert
AFTER INSERT ON Admin
FOR EACH ROW
BEGIN
    INSERT INTO alluser (email) VALUES (NEW.email);
END;
$$
DELIMITER ;


**************************SQL queries for itutor**************************************




***********************API key for Youtube**********************************************

AIzaSyBY3alvfttcwtNPoYvXLBziDeVXJDwCrmE

***********************API key for Youtube**********************************************

