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
