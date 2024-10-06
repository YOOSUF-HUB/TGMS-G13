-- Create the Admin table
CREATE TABLE Admin (
    Admin_ID INT PRIMARY KEY,
    Password VARCHAR(50),
    Email VARCHAR(100),
    First_name VARCHAR(50),
    Last_name VARCHAR(50)
);

-- Create the Staff_account table
CREATE TABLE Staff_account (
    Staff_ID INT PRIMARY KEY,
    Email VARCHAR(100),
    Date_created DATE,
    Password VARCHAR(50),
    First_name VARCHAR(50),
    Last_name VARCHAR(50)
);

-- Create the Customer_account table
CREATE TABLE Customer_account (
    Customer_ID INT PRIMARY KEY,
    Dob DATE,
    Address VARCHAR(255),
    Password VARCHAR(50),
    Date_created DATE,
    Email VARCHAR(100),
    First_name VARCHAR(50),
    Last_name VARCHAR(50)
);

-- Create the Customer_Support table
CREATE TABLE Customer_Support (
    Customersupport_ID INT PRIMARY KEY,
    Email VARCHAR(100),
    First_name VARCHAR(50),
    Password VARCHAR(50),
    Address VARCHAR(255)
);

-- Create the Inquiries table
CREATE TABLE Inquiries (
    Inquiry_ID INT PRIMARY KEY,
    Email VARCHAR(100),
    Date DATE,
    Time TIME
);

-- Create the Inventory table
CREATE TABLE Inventory (
    Product_ID INT PRIMARY KEY,
    Colour VARCHAR(50),
    Quantity INT,
    Size VARCHAR(50),
    Type VARCHAR(50),
    Name VARCHAR(100)
);

-- Create the Supplier table
CREATE TABLE Supplier (
    Supplier_ID INT PRIMARY KEY,
    Category VARCHAR(50),
    Supplier_Name VARCHAR(100),
    Email VARCHAR(100),
    Company_name VARCHAR(100),
    Supply VARCHAR(100)
);

-- Create the Order table
CREATE TABLE Orders (
    Order_ID INT PRIMARY KEY,
    Total_Amount DECIMAL(10, 2),
    Status VARCHAR(50),
    DeliveryDate DATE,
    Order_type VARCHAR(50),
    OrderedDate DATE,
    Admin_ID INT,
    Supplier_ID INT,
    Customer_ID INT,
    InventoryManager_ID INT,
    FOREIGN KEY (Admin_ID) REFERENCES Admin(Admin_ID),
    FOREIGN KEY (Supplier_ID) REFERENCES Supplier(Supplier_ID),
    FOREIGN KEY (Customer_ID) REFERENCES Customer_account(Customer_ID),
    FOREIGN KEY (InventoryManager_ID) REFERENCES Inventory_Manager(InventoryManager_ID)
);

-- Create the Inventory_Manager table
CREATE TABLE Inventory_Manager (
    InventoryManager_ID INT PRIMARY KEY,
    Email VARCHAR(100),
    User_Name VARCHAR(50),
    Password VARCHAR(50)
);

-- Create the Report table
CREATE TABLE Report (
    Report_ID INT PRIMARY KEY,
    Type VARCHAR(50),
    Title VARCHAR(100),
    Date DATE,
    Start_date DATE,
    End_date DATE,
    InventoryManager_ID INT,
    FOREIGN KEY (InventoryManager_ID) REFERENCES Inventory_Manager(InventoryManager_ID)
);

-- Create the Customer_account_Phone_no table
CREATE TABLE Customer_account_Phone_no (
    Customer_ID INT,
    Phone_no VARCHAR(15),
    PRIMARY KEY (Customer_ID, Phone_no),
    FOREIGN KEY (Customer_ID) REFERENCES Customer_account(Customer_ID)
);

-- Create the Customer_support_Phone_no table
CREATE TABLE Customer_support_Phone_no (
    Customersupport_ID INT,
    Phone_no VARCHAR(15),
    PRIMARY KEY (Customersupport_ID, Phone_no),
    FOREIGN KEY (Customersupport_ID) REFERENCES Customer_Support(Customersupport_ID)
);

-- Create the Inquiries_Phone_no table
CREATE TABLE Inquiries_Phone_no (
    Inquiry_ID INT,
    Phone_no VARCHAR(15),
    PRIMARY KEY (Inquiry_ID, Phone_no),
    FOREIGN KEY (Inquiry_ID) REFERENCES Inquiries(Inquiry_ID)
);

-- Create the Payment table
CREATE TABLE Payment (
    Payment_Id INT PRIMARY KEY,
    Customer_ID INT,
    Amount DECIMAL(10, 2),
    FOREIGN KEY (Customer_ID) REFERENCES Customer_account(Customer_ID)
);




--2nd sql
-- Create Admin table
CREATE TABLE Admin (
    Admin_ID VARCHAR(10) PRIMARY KEY,
    First_name VARCHAR(100) NOT NULL,
    Last_name VARCHAR(100) NOT NULL,
    Email VARCHAR(100) NOT NULL UNIQUE,
    Password VARCHAR(255) NOT NULL,
);

-- Create Customer_account table
CREATE TABLE Customer_account (
    Customer_ID VARCHAR(10) PRIMARY KEY,
    First_name VARCHAR(50) NOT NULL,
    Last_name VARCHAR(50) NOT NULL,
    Email VARCHAR(100) NOT NULL UNIQUE,
    Password VARCHAR(255) NOT NULL,
    Address VARCHAR(255),
    Phone_no VARCHAR(15),
    Dob DATE,
    Date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    Admin_ID VARCHAR(10),


    CONSTRAINT FK_Admin FOREIGN KEY (Admin_ID) REFERENCES Admin(Admin_ID),

);

-- Create Staff_account table
CREATE TABLE Staff_account (
    Staff_ID VARCHAR(10) NOT NULL,
    First_name VARCHAR(50) NOT NULL,
    Last_name VARCHAR(50) NOT NULL,
    Email VARCHAR(100) NOT NULL UNIQUE,
    Password VARCHAR(255) NOT NULL,
    Date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    Admin_ID VARCHAR(10),

    CONSTRAINT Staff_account_PK PRIMARY KEY (Staff_ID),
    CONSTRAINT Staff_account_FK FOREIGN KEY (Admin_ID) REFERENCES Admin(Admin_ID)
);

-- Create Inquiries table
CREATE TABLE Inquiries (
    Inquiry_ID INT AUTO_INCREMENT,
    Email VARCHAR(100) NOT NULL,
    Date DATE DEFAULT CURRENT_DATE,
    Time TIME DEFAULT CURRENT_TIME,
    Customer_ID INT,

    CONSTRAINT Inquiries_PK PRIMARY KEY (Inquiry_ID),
    CONSTRAINT Inquiries_FK FOREIGN KEY (Customer_ID) REFERENCES Customer_account(Customer_ID)
);

-- Create Order table
CREATE TABLE `Order` (
    Order_ID INT PRIMARY KEY AUTO_INCREMENT,
    Customer_ID INT,
    Delivery_Date DATE,
    Ordered_Date DATE,
    Total_Amount DECIMAL(10, 2),
    Status ENUM('Pending', 'Shipped', 'Delivered', 'Cancelled') NOT NULL,
    FOREIGN KEY (Customer_ID) REFERENCES Customer_account(Customer_ID)
);

-- Create Payment table
CREATE TABLE Payment (
    Payment_ID INT AUTO_INCREMENT,
    Order_ID INT,
    Amount DECIMAL(10, 2) NOT NULL,
    Payment_Type ENUM('Bank_transfer', 'Card') NOT NULL,
    FOREIGN KEY (Order_ID) REFERENCES `Order`(Order_ID)

    CONSTRAINT Payment_PK PRIMARY KEY (Payment_ID),
);

-- Create Inventory table
CREATE TABLE Inventory (
    Product_ID INT PRIMARY KEY AUTO_INCREMENT,
    Name VARCHAR(100) NOT NULL,
    Type VARCHAR(50),
    Size VARCHAR(10),
    Colour VARCHAR(20),
    Quantity INT NOT NULL
);

-- Create Supplier table
CREATE TABLE Supplier (
    Supplier_ID INT PRIMARY KEY AUTO_INCREMENT,
    Supplier_Name VARCHAR(100) NOT NULL,
    Phone_Number VARCHAR(15),
    Email VARCHAR(100),
    Company_Name VARCHAR(100)
);

-- Create Report table
CREATE TABLE Report (
    Report_ID INT PRIMARY KEY AUTO_INCREMENT,
    Title VARCHAR(255) NOT NULL,
    Period_Covered VARCHAR(50),
    Date DATE,
    Type VARCHAR(50),
    Start_date DATE,
    End_date DATE,
    Staff_ID INT,
    FOREIGN KEY (Staff_ID) REFERENCES Staff_account(Staff_ID)
);

-- Create Supplier_Inventory junction table for many-to-many relationship
CREATE TABLE Supplier_Inventory (
    Supplier_ID INT,
    Product_ID INT,
    PRIMARY KEY (Supplier_ID, Product_ID),
    FOREIGN KEY (Supplier_ID) REFERENCES Supplier(Supplier_ID),
    FOREIGN KEY (Product_ID) REFERENCES Inventory(Product_ID)
);
