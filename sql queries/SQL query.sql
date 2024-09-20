
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

-- Manually inserting data into table using MYSQL
-- INSERT INTO `Staff_account` (`Staff_ID`, `First_name`, `Last_name`, `Email`, `Password`, `Date_created`) 
-- VALUES (001, 'John', 'Smith', 'js@gmail.com', '123', CURRENT_DATE);



-- to change name of thr column
ALTER TABLE customer CHANGE customer_id_num customer_id INT AUTO_INCREMENT;
