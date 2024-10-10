-- Create Admin table
CREATE TABLE Admin (
    Admin_ID VARCHAR(10) PRIMARY KEY,
    First_name VARCHAR(100) NOT NULL,
    Last_name VARCHAR(100) NOT NULL,
    Email VARCHAR(100) NOT NULL UNIQUE,
    Password VARCHAR(255) NOT NULL
);

-- Create Customer_account table
CREATE TABLE Customer_account (
    Customer_ID VARCHAR(10) PRIMARY KEY,
    First_name VARCHAR(50) NOT NULL,
    Last_name VARCHAR(50) NOT NULL,
    Email VARCHAR(100) NOT NULL UNIQUE,
    Password VARCHAR(255) NOT NULL,
    Address VARCHAR(255),
    Dob DATE,
    Date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    Admin_ID VARCHAR(10),
    CONSTRAINT FK_Admin FOREIGN KEY (Admin_ID) REFERENCES Admin(Admin_ID)
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

-- Create Customer_Support table
CREATE TABLE Customer_Support (
    Customersupport_ID VARCHAR(10) PRIMARY KEY,
    First_name VARCHAR(50) NOT NULL,
    Last_name VARCHAR(50) NOT NULL,
    Email VARCHAR(100) NOT NULL UNIQUE,
    Password VARCHAR(255) NOT NULL
);

-- Create Inquiries table
CREATE TABLE Inquiries (
    Inquiry_ID VARCHAR(10) NOT NULL,
    Email VARCHAR(100) NOT NULL,
    Date DATE DEFAULT CURRENT_DATE,
    Time TIME DEFAULT CURRENT_TIME,
    Customer_ID VARCHAR(10),
    Customersupport_ID VARCHAR(10),
    CONSTRAINT Inquiries_PK PRIMARY KEY (Inquiry_ID),
    CONSTRAINT Inquiries_FK FOREIGN KEY (Customer_ID) REFERENCES Customer_account(Customer_ID),
    CONSTRAINT Inquiries_FK2 FOREIGN KEY (Customersupport_ID) REFERENCES Customer_Support(Customersupport_ID)
);

-- Create Order table
CREATE TABLE `Order` (
    Order_ID VARCHAR(10) NOT NULL,
    Status ENUM('In-Progress', 'Shipped', 'Delivered', 'Cancelled') NOT NULL,
    Total_Amount DECIMAL(10, 2) NOT NULL,
    Delivery_Date DATE NOT NULL,
    Ordered_Date DATE NOT NULL,
    Order_Type VARCHAR(50) NOT NULL,
    Customer_ID VARCHAR(10) NOT NULL,
    CONSTRAINT Order_PK PRIMARY KEY (Order_ID),
    CONSTRAINT Order_FK FOREIGN KEY (Customer_ID) REFERENCES Customer_account(Customer_ID)
);

-- Create Payment table
CREATE TABLE Payment (
    Payment_ID VARCHAR(10) NOT NULL,
    Customer_ID VARCHAR(10) NOT NULL,
    Amount DECIMAL(10, 2) NOT NULL,
    CONSTRAINT Payment_PK PRIMARY KEY (Payment_ID),
    CONSTRAINT Payment_FK FOREIGN KEY (Customer_ID) REFERENCES Customer_account(Customer_ID)
);

-- Create Inventory_Manager table
CREATE TABLE Inventory_Manager (
    InventoryManager_ID VARCHAR(10) PRIMARY KEY,
    User_name VARCHAR(50) NOT NULL,
    Name VARCHAR(100) NOT NULL,
    Email VARCHAR(100) NOT NULL UNIQUE,
    Password VARCHAR(255) NOT NULL
);

-- Create Inventory table
CREATE TABLE Inventory (
    Product_ID VARCHAR(10) NOT NULL,
    Name VARCHAR(100) NOT NULL,
    Type VARCHAR(50),
    Size VARCHAR(20),
    Colour VARCHAR(20),
    Quantity INT NOT NULL,
    InventoryManager_ID VARCHAR(10) NOT NULL,
    CONSTRAINT Inventory_PK PRIMARY KEY (Product_ID),
    CONSTRAINT Inventory_FK FOREIGN KEY (InventoryManager_ID) REFERENCES Inventory_Manager(InventoryManager_ID)
);

-- Create Supplier table
CREATE TABLE Supplier (
    Supplier_ID VARCHAR(10) NOT NULL,
    Supplier_Name VARCHAR(100) NOT NULL,
    Phone_Number VARCHAR(15),
    Email VARCHAR(100),
    Company_Name VARCHAR(100),
    Category VARCHAR(100),
    Supply VARCHAR(100),
    InventoryManager_ID VARCHAR(10) NOT NULL,
    CONSTRAINT Supplier_PK PRIMARY KEY (Supplier_ID),
    CONSTRAINT Supplier_FK FOREIGN KEY (InventoryManager_ID) REFERENCES Inventory_Manager(InventoryManager_ID)
);

-- Create Report table
CREATE TABLE Report (
    Report_ID VARCHAR(10) NOT NULL,
    Title VARCHAR(255) NOT NULL,
    Start_date DATE NOT NULL,
    End_date DATE NOT NULL,
    Type VARCHAR(50),
    Date DATE NOT NULL,
    InventoryManager_ID VARCHAR(10) NOT NULL,
    CONSTRAINT Report_PK PRIMARY KEY (Report_ID),
    CONSTRAINT Report_FK FOREIGN KEY (InventoryManager_ID) REFERENCES Inventory_Manager(InventoryManager_ID)
);

-- Create Supplier_Inventory junction table for many-to-many relationship
CREATE TABLE Supplier_Inventory (
    Supplier_ID VARCHAR(10),
    Product_ID VARCHAR(10),
    PRIMARY KEY (Supplier_ID, Product_ID),
    FOREIGN KEY (Supplier_ID) REFERENCES Supplier(Supplier_ID),
    FOREIGN KEY (Product_ID) REFERENCES Inventory(Product_ID)
);

-- Table registered user contact
CREATE TABLE Customer_account_Phone_no (
    Customer_ID VARCHAR(20) NOT NULL,
    Phone_no DECIMAL(10) NOT NULL,
    CONSTRAINT Customer_account_Phone_no_PK PRIMARY KEY(Customer_ID),
    CONSTRAINT Customer_account_Phone_no_FK FOREIGN KEY (Customer_ID) REFERENCES Customer_account(Customer_ID)
);

-- Table registered user contact
CREATE TABLE Customer_support_Phone_no (
    Customersupport_ID VARCHAR(20) NOT NULL,
    Phone_no DECIMAL(10) NOT NULL,
    CONSTRAINT Customer_support_Phone_no_PK PRIMARY KEY(Customersupport_ID),
    CONSTRAINT Customer_support_Phone_no_FK FOREIGN KEY (Customersupport_ID) REFERENCES Customer_Support(Customersupport_ID)
);

-- Table registered user contact
CREATE TABLE Inquiries_Phone_no (
    Inquiry_ID VARCHAR(20) NOT NULL,
    Phone DECIMAL(10) NOT NULL,
    CONSTRAINT Inquiries_Phone_no_PK PRIMARY KEY(Inquiry_ID),
    CONSTRAINT Inquiries_Phone_no_FK FOREIGN KEY (Inquiry_ID) REFERENCES Inquiries(Inquiry_ID)
);