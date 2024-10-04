
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

CREATE TABLE Cart (
    cartID INT AUTO_INCREMENT PRIMARY KEY,
    Customer_ID varchar(255) NOT NULL,
    productName VARCHAR(255) NOT NULL,
    productID INT NOT NULL,
    size VARCHAR(50) NOT NULL,
    color VARCHAR(50) NOT NULL,
    quantity INT NOT NULL,
    FOREIGN KEY (Customer_ID) REFERENCES Customer_account(Customer_ID)
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
CREATE Table Orders(
    Order_ID varchar(255) NOT NULL PRIMARY KEY,
    Customer_ID varchar(255) NOT NULL,
    Product_ID varchar(255) NOT NULL,
    Order_Date DATE NOT NULL,
    Delivery_Date DATE,
    Order_type varchar(255) NOT NULL,
    Status ENUM('In-Progress', 'Out for delivery', 'Delivered', 'Cancelled') NOT NULL,
    Total_amount varchar(255) NOT NULL,

	CONSTRAINT Orders_FK FOREIGN KEY (Customer_ID) REFERENCES Customer_account(Customer_ID),
    CONSTRAINT Orders_FK2 FOREIGN KEY (Product_ID) REFERENCES Inventory(Product_ID)
);

CREATE TABLE Payments (
    Payment_ID varchar(255) NOT NULL PRIMARY KEY,
    Order_ID varchar(255) NOT NULL,
    Customer_ID varchar(255) NOT NULL,
    Payment_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    Payment_amount DECIMAL(10, 2) NOT NULL,
    Payment_method ENUM('Credit Card', 'Debit Card', 'Bank Transfer', 'Mobile Payment') NOT NULL,
    Transaction_id VARCHAR(100) UNIQUE,

    CONSTRAINT Payments_FK1 FOREIGN KEY (Order_ID) REFERENCES Orders(Order_ID),
    CONSTRAINT Payments_FK2 FOREIGN KEY (Customer_ID) REFERENCES Customer_account(Customer_ID)
);
CREATE TABLE Payments (
    Payment_ID varchar(255) NOT NULL PRIMARY KEY,
    Payment_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    Payment_amount DECIMAL(10, 2) NOT NULL,
    Payment_method varchar(255) NOT NULL,
    Transaction_id VARCHAR(100) UNIQUE
);

CREATE Table Orders(
    Order_ID varchar(255) NOT NULL PRIMARY KEY,
    Customer_ID varchar(255) NOT NULL,
    Product_ID varchar(255) NOT NULL,
    Payment_ID varchar(255) NOT NULL,
    Order_Date DATE NOT NULL,
    Delivery_Date DATE,
    Order_type varchar(255) NOT NULL,
    Status varchar(255) NOT NULL,

	CONSTRAINT Orders_FK FOREIGN KEY (Customer_ID) REFERENCES Customer_account(Customer_ID),
    CONSTRAINT Orders_FK2 FOREIGN KEY (Product_ID) REFERENCES Inventory(Product_ID),
    CONSTRAINT Orders_FK3 FOREIGN KEY (Payment_ID) REFERENCES Payments(Payment_ID)
);



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
    Other VARCHAR(255),
    Customer_ID VARCHAR(255),  -- Foreign key column
    CONSTRAINT fk_consultation_customer
        FOREIGN KEY (Customer_ID) REFERENCES Customer_account(Customer_ID)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);



CREATE TABLE Inquiries (
    Inquiry_ID VARCHAR(50) NOT NULL PRIMARY KEY,
    Inquiry_Date DATETIME NOT NULL,
    First_name VARCHAR(255) NOT NULL,
    Last_name VARCHAR(255) NOT NULL,
    Email VARCHAR(255) NOT NULL,
    Phone_no VARCHAR(20) NOT NULL,
    Topic VARCHAR(255) NOT NULL,
    Other VARCHAR(1000),
    Customer_ID VARCHAR(255),  -- Foreign key column
    CONSTRAINT fk_customer
        FOREIGN KEY (Customer_ID) REFERENCES Customer_account(Customer_ID) 
        ON DELETE CASCADE
        ON UPDATE CASCADE

);

--sample user table for admin
CREATE TABLE users (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
    role varchar(255) NOT NULL
);
-- staff table for IWT
CREATE TABLE Staff_account ( 
    Staff_ID varchar(255) NOT NULL PRIMARY KEY, 
    Full_name varchar(255) NOT NULL, 
    username varchar(255) NOT NULL, 
    staff_role varchar(255) NOT NULL,
    Email varchar(255) NOT NULL, 
    Password varchar(255) NOT NULL
    Date_created DATE DEFAULT CURRENT_DATE
);
INSERT INTO Staff_account (Staff_ID, Full_name, username, staff_role, Email, password, Date_created) VALUES ('S001', 'Nivin Pauly', 'nivin12', 'inventory', 'nivin@versori.com', 'nivin123');

-- Inventory Table
CREATE TABLE Inventory (
    Product_ID varchar(255) NOT NULL PRIMARY KEY,
    Name varchar(255) NOT NULL,
    Colour varchar(255) NOT NULL,
    Size varchar(255) NOT NULL,
    Type varchar(255) NOT NULL,
    Quantity varchar(255)
);
-- Sample Data for invntory
INSERT INTO `Inventory`(`Product_ID`, `Name`, `Colour`, `Size`, `Type`, `Quantity`) VALUES ('VER001','HOODIES','Yellow','Large','Pullover','250');
INSERT INTO `Inventory`(`Product_ID`, `Name`, `Colour`, `Size`, `Type`, `Quantity`) VALUES ('VER002','T-Shirt','White','Large','Crewneck T-shirt','500');
INSERT INTO `Inventory`(`Product_ID`, `Name`, `Colour`, `Size`, `Type`, `Quantity`) VALUES ('VER003','JOGGERS','Black','Large','Elastic Waistband Trousers','350');
INSERT INTO `Inventory`(`Product_ID`, `Name`, `Colour`, `Size`, `Type`, `Quantity`) VALUES ('VER004','TANK TOP','Black','Extra Large','Tops','150');


-- Manually inserting data into table using MYSQL
-- INSERT INTO `Staff_account` (`Staff_ID`, `First_name`, `Last_name`, `Email`, `Password`, `Date_created`) 
-- VALUES (001, 'John', 'Smith', 'js@gmail.com', '123', CURRENT_DATE);



-- to change name of thr column
ALTER TABLE customer CHANGE customer_id_num customer_id INT AUTO_INCREMENT;





INSERT INTO `Inventory`(`Product_ID`, `Name`, `Colour`, `Size`, `Type`, `Quantity`) VALUES ('VER-1-001','HOODIES','Yellow','Large','Pullover','250');
INSERT INTO `Inventory`(`Product_ID`, `Name`, `Colour`, `Size`, `Type`, `Quantity`) VALUES
('VER-2-001','T-Shirt','Yellow','Large','Crewneck T-shirt','233');
INSERT INTO `Inventory`(`Product_ID`, `Name`, `Colour`, `Size`, `Type`, `Quantity`) VALUES ('VER-3-001','JOGGERS','Black','Large','Elastic Waistband Trousers','350');
INSERT INTO `Inventory`(`Product_ID`, `Name`, `Colour`, `Size`, `Type`, `Quantity`) VALUES 
('VER-4-001','TANK TOP','Black','Large','Tops','353');
INSERT INTO `Inventory`(`Product_ID`, `Name`, `Colour`, `Size`, `Type`, `Quantity`) VALUES ('VER-1-002','HOODIES','Yellow','Medium','Pullover','833');
INSERT INTO `Inventory`(`Product_ID`, `Name`, `Colour`, `Size`, `Type`, `Quantity`) VALUES
('VER-2-002','T-Shirt','Yellow','Medium','Crewneck T-shirt','324');
INSERT INTO `Inventory`(`Product_ID`, `Name`, `Colour`, `Size`, `Type`, `Quantity`) VALUES ('VER-3-002','JOGGERS','Black','Medium','Elastic Waistband Trousers','123');
INSERT INTO `Inventory`(`Product_ID`, `Name`, `Colour`, `Size`, `Type`, `Quantity`) VALUES 
('VER-4-002','TANK TOP','Black','Medium','Tops','433');
INSERT INTO `Inventory`(`Product_ID`, `Name`, `Colour`, `Size`, `Type`, `Quantity`) VALUES ('VER-1-003','HOODIES','Yellow','Small','Pullover','122');
INSERT INTO `Inventory`(`Product_ID`, `Name`, `Colour`, `Size`, `Type`, `Quantity`) VALUES
('VER-2-003','T-Shirt','Yellow','Small','Crewneck T-shirt','123');
INSERT INTO `Inventory`(`Product_ID`, `Name`, `Colour`, `Size`, `Type`, `Quantity`) VALUES ('VER-3-003','JOGGERS','Black','Small','Elastic Waistband Trousers','113');
INSERT INTO `Inventory`(`Product_ID`, `Name`, `Colour`, `Size`, `Type`, `Quantity`) VALUES 
('VER-4-003','TANK TOP','Black','Small','Tops','432');
INSERT INTO `Inventory`(`Product_ID`, `Name`, `Colour`, `Size`, `Type`, `Quantity`) VALUES ('VER-1-004','HOODIES','White','Large','Pullover','250');
INSERT INTO `Inventory`(`Product_ID`, `Name`, `Colour`, `Size`, `Type`, `Quantity`) VALUES
('VER-2-004','T-Shirt','White','Large','Crewneck T-shirt','500');
INSERT INTO `Inventory`(`Product_ID`, `Name`, `Colour`, `Size`, `Type`, `Quantity`) VALUES ('VER-3-004','JOGGERS','Blue','Large','Elastic Waistband Trousers','324');
INSERT INTO `Inventory`(`Product_ID`, `Name`, `Colour`, `Size`, `Type`, `Quantity`) VALUES 
('VER-4-004','TANK TOP','Blue','Large','Tops','150');
INSERT INTO `Inventory`(`Product_ID`, `Name`, `Colour`, `Size`, `Type`, `Quantity`) VALUES ('VER-1-005','HOODIES','White','Medium','Pullover','250');
INSERT INTO `Inventory`(`Product_ID`, `Name`, `Colour`, `Size`, `Type`, `Quantity`) VALUES
('VER-2-005','T-Shirt','White','Medium','Crewneck T-shirt','500');
INSERT INTO `Inventory`(`Product_ID`, `Name`, `Colour`, `Size`, `Type`, `Quantity`) VALUES ('VER-3-005','JOGGERS','Blue','Medium','Elastic Waistband Trousers','350');
INSERT INTO `Inventory`(`Product_ID`, `Name`, `Colour`, `Size`, `Type`, `Quantity`) VALUES 
('VER-4-005','TANK TOP','Blue','Medium','Tops','150');
INSERT INTO `Inventory`(`Product_ID`, `Name`, `Colour`, `Size`, `Type`, `Quantity`) VALUES ('VER-1-006','HOODIES','White','Small','Pullover','250');
INSERT INTO `Inventory`(`Product_ID`, `Name`, `Colour`, `Size`, `Type`, `Quantity`) VALUES
('VER-2-006','T-Shirt','White','Small','Crewneck T-shirt','234');
INSERT INTO `Inventory`(`Product_ID`, `Name`, `Colour`, `Size`, `Type`, `Quantity`) VALUES ('VER-3-006','JOGGERS','Blue','Small','Elastic Waistband Trousers','230');
INSERT INTO `Inventory`(`Product_ID`, `Name`, `Colour`, `Size`, `Type`, `Quantity`) VALUES 
('VER-4-006','TANK TOP','Blue','Small','Tops','490');

-- Price Table
CREATE TABLE Price(
    HOODIES INT(255) NOT NULL,
    TSHIRT INT(255) NOT NULL,
    JOGGERS INT(255) NOT NULL,
    LSLEEVE INT(255) NOT NULL
);