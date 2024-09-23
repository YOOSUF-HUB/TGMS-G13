
-- Customer Table
CREATE TABLE Customer_account (
    Customer_ID varchar(255) NOT NULL PRIMARY KEY,
    First_name varchar(255),
    Last_name varchar(255) NOT NULL,
    Email varchar(255) NOT NULL,
    Password varchar(255) NOT NULL,
    Address varchar(255),
    Phone_no varchar(255),
    Dob DATE,
    Date_created DATE DEFAULT CURRENT_DATE
);

-- Staff Table
CREATE TABLE Staff_account (
    Staff_ID varchar(255) NOT NULL PRIMARY KEY,
    First_name varchar(255),
    Last_name varchar(255) NOT NULL,
    Email varchar(255) NOT NULL,
    Password varchar(255) NOT NULL,
    Date_created DATE DEFAULT CURRENT_DATE
)

-- Order Table
CREATE TABLE Orders (
    Order_ID varchar(255) NOT NULL PRIMARY KEY,
    Ordered_Date varchar(255) NOT NULL,
    Order_type varchar(255) NOT NULL,
    Delivery_Date varchar(255) NOT NULL,
    Status varchar(255) NOT NULL,
    Total_amount varchar(255) NOT NULL,
)


-- Consultation Table
CREATE TABLE Consultation (
    Consultation_ID VARCHAR(255) NOT NULL PRIMARY KEY,
    Consultation_Date VARCHAR(255) NOT NULL,
    Full_name VARCHAR(255) NOT NULL,
    Email VARCHAR(255) NOT NULL,
    Phone_no VARCHAR(255) NOT NULL,
    Company_name VARCHAR(255),
    Company_website_URL VARCHAR(255),
    Company_scale VARCHAR(255),
    Brand_overview VARCHAR(255) NOT NULL,
    Other VARCHAR(255)
);

-- Inquiry Table
CREATE TABLE Inquiries (
    Inquiry_ID VARCHAR(50) NOT NULL PRIMARY KEY,
    Inquiry_Date DATETIME NOT NULL,
    First_name VARCHAR(255) NOT NULL,
    Last_name VARCHAR(255) NOT NULL,
    Phone_no VARCHAR(20) NOT NULL,
    Email VARCHAR(255) NOT NULL,
    Topic VARCHAR(255) NOT NULL,
    Other VARCHAR(1000)
);

-- Manually inserting data into table using MYSQL
-- INSERT INTO `Staff_account` (`Staff_ID`, `First_name`, `Last_name`, `Email`, `Password`, `Date_created`) 
-- VALUES (001, 'John', 'Smith', 'js@gmail.com', '123', CURRENT_DATE);



-- to change name of thr column
ALTER TABLE customer CHANGE customer_id_num customer_id INT AUTO_INCREMENT;
