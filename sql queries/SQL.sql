

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
    Inquiry_ID  VARCHAR(10) NOT NULL,
    Email VARCHAR(100) NOT NULL,
    Date DATE DEFAULT CURRENT_DATE,
    Time TIME DEFAULT CURRENT_TIME,
    Customer_ID VARCHAR(10),
    Customersupport_ID VARCHAR(10),

    CONSTRAINT Inquiries_PK PRIMARY KEY (Inquiry_ID),
    CONSTRAINT Inquiries_FK FOREIGN KEY (Customer_ID) REFERENCES Customer_account(Customer_ID),
    CONSTRAINT Inquiries_FK2 FOREIGN KEY (Customersupport_ID) REFERENCES Customer_Support(Customersupport_ID)
);

-- Create Customer_Support table
CREATE TABLE Customer_Support (
    Customersupport_ID VARCHAR(10),
    First_name VARCHAR(50) NOT NULL,
    Last_name VARCHAR(50) NOT NULL,
    Email VARCHAR(100) NOT NULL UNIQUE,
    Password VARCHAR(255) NOT NULL,

    CONSTRAINT Customer_Support_PK PRIMARY KEY (Customersupport_ID),
);

-- Create Order table
CREATE TABLE Order (
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

-- Create Inventory_Manager table
CREATE TABLE Inventory_Manager (
    InventoryManager_ID VARCHAR(10),
    User_name VARCHAR(50) NOT NULL,
    Name VARCHAR(100) NOT NULL,
    Email VARCHAR(100) NOT NULL UNIQUE,
    Password VARCHAR(255) NOT NULL,

    CONSTRAINT Inventory_Manager_PK PRIMARY KEY (InventoryManager_ID)
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
    CONSTRAINT Inventory_FK FOREIGN KEY (InventoryManager_ID) REFERENCES Inventory_Manager(InventoryManager_ID)
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
    Supplier_ID INT,
    Product_ID INT,
    PRIMARY KEY (Supplier_ID, Product_ID),
    FOREIGN KEY (Supplier_ID) REFERENCES Supplier(Supplier_ID),
    FOREIGN KEY (Product_ID) REFERENCES Inventory(Product_ID)
);


/*Table registered user contact*/
CREATE TABLE Customer_account_Phone_no(
    Customer_ID varchar(20)not null,
    Phone_no decimal(10)not null,

    CONSTRAINT Customer_account_Phone_no_PK PRIMARY KEY(Customer_ID),
    CONSTRAINT Customer_account_Phone_no_FK FOREIGN KEY (Customer_ID) References Customer_account(Customer_ID)
);

/*Table registered user contact*/
CREATE TABLE Customer_support_Phone_no(
    Customersupport_ID varchar(20)not null,
    Phone_no decimal(10)not null,

    CONSTRAINT Customer_support_Phone_no_PK PRIMARY KEY(Customer_ID),
    CONSTRAINT Customer_support_Phone_no_FK FOREIGN KEY (Customersupport_ID) References Customer_Support(Customersupport_ID)
);

/*Table registered user contact*/
CREATE TABLE Inquiries_Phone_no(
    Inquiry_ID varchar(20)not null,
    Phone decimal(10)not null,

    CONSTRAINT Inquiries_Phone_no_PK PRIMARY KEY(Inquiry_ID),
    CONSTRAINT Inquiries_Phone_no_FK FOREIGN KEY (Inquiry_ID) References Inquiries(Inquiry_ID)
);




INSERT INTO Admin (Admin_ID, First_name, Last_name, Email, Password) VALUES
('A001', 'Nimal', 'Perera', 'nimal.perera@example.lk', 'password123'),
('A002', 'Kumari', 'Fernando', 'kumari.fernando@example.lk', 'password456'),
('A003', 'Sunil', 'Wijesinghe', 'sunil.wijesinghe@example.lk', 'password789'),
('A004', 'Anura', 'De Silva', 'anura.desilva@example.lk', 'password101'),
('A005', 'Ruwan', 'Jayasinghe', 'ruwan.jayasinghe@example.lk', 'password202');



INSERT INTO Customer_account (Customer_ID, First_name, Last_name, Email, Password, Address, Dob, Admin_ID) VALUES
('C001', 'Kamal', 'Perera', 'kamal.perera@example.lk', 'password123', '123 Galle Road, Colombo', '1985-05-15', 'A001'),
('C002', 'Saman', 'Fernando', 'saman.fernando@example.lk', 'password456', '456 Kandy Road, Kandy', '1990-08-20', 'A002'),
('C003', 'Nuwan', 'Silva', 'nuwan.silva@example.lk', 'password789', '789 Main Street, Galle', '1988-12-10', 'A003'),
('C004', 'Ruwan', 'Jayasinghe', 'ruwan.jayasinghe@example.lk', 'password101', '101 Beach Road, Matara', '1992-03-25', 'A004'),
('C005', 'Anjali', 'Wijesinghe', 'anjali.wijesinghe@example.lk', 'password202', '202 Lake Road, Nuwara Eliya', '1987-07-30', 'A005');


INSERT INTO Staff_account (Staff_ID, First_name, Last_name, Email, Password, Admin_ID) VALUES
('S001', 'Lakmal', 'Perera', 'lakmal.perera@example.lk', 'password123', 'A001'),
('S002', 'Nadeesha', 'Fernando', 'nadeesha.fernando@example.lk', 'password456', 'A002'),
('S003', 'Tharindu', 'Silva', 'tharindu.silva@example.lk', 'password789', 'A003'),
('S004', 'Dilshan', 'Jayasinghe', 'dilshan.jayasinghe@example.lk', 'password101', 'A004'),
('S005', 'Chamari', 'Wijesinghe', 'chamari.wijesinghe@example.lk', 'password202', 'A005');



INSERT INTO Inquiries (Inquiry_ID, Email, Date, Time, Customer_ID, Customersupport_ID) VALUES
('I001', 'kamal.perera@example.lk', CURRENT_DATE, CURRENT_TIME, 'C001', 'S001'),
('I002', 'saman.fernando@example.lk', CURRENT_DATE, CURRENT_TIME, 'C002', 'S002'),
('I003', 'nuwan.silva@example.lk', CURRENT_DATE, CURRENT_TIME, 'C003', 'S003'),
('I004', 'ruwan.jayasinghe@example.lk', CURRENT_DATE, CURRENT_TIME, 'C004', 'S004'),
('I005', 'anjali.wijesinghe@example.lk', CURRENT_DATE, CURRENT_TIME, 'C005', 'S005');

INSERT INTO Customer_Support (Customersupport_ID, First_name, Last_name, Email, Password) VALUES
('S001', 'Nimal', 'Perera', 'nimal.perera@example.lk', 'password123'),
('S002', 'Kumari', 'Fernando', 'kumari.fernando@example.lk', 'password456'),
('S003', 'Sunil', 'Wijesinghe', 'sunil.wijesinghe@example.lk', 'password789'),
('S004', 'Anura', 'De Silva', 'anura.desilva@example.lk', 'password101'),
('S005', 'Ruwan', 'Jayasinghe', 'ruwan.jayasinghe@example.lk', 'password202');

INSERT INTO `Order` (Order_ID, Status, Total_Amount, Delivery_Date, Ordered_Date, Order_Type, Customer_ID) VALUES
('O001', 'In-Progress', 1500.00, '2024-10-10', '2024-10-01', 'Online', 'C001'),
('O002', 'Shipped', 2500.50, '2024-10-12', '2024-10-02', 'In-Store', 'C002'),
('O003', 'Delivered', 3200.75, '2024-10-08', '2024-10-03', 'Online', 'C003'),
('O004', 'Cancelled', 1800.00, '2024-10-15', '2024-10-05', 'In-Store', 'C004'),
('O005', 'Delivered', 2200.00, '2024-10-09', '2024-10-04', 'Online', 'C005');

INSERT INTO Payment (Payment_ID, Customer_ID, Amount) VALUES
('P001', 'C001', 1500.00),
('P002', 'C002', 2500.50),
('P003', 'C003', 3200.75),
('P004', 'C004', 1800.00),
('P005', 'C005', 2200.00);

INSERT INTO Inventory (Product_ID, Name, Type, Size, Colour, Quantity, InventoryManager_ID) VALUES
('PD001', 'Hoodies', 'Cotton', 'Small', 'Red', 50, 'IM001'),
('PD002', 'Tshirts', 'Polyester', 'Medium', 'Black', 200, 'IM002'),
('PD003', 'Joggers', 'Cotton', 'Large', 'Blue', 500, 'IM003'),
('PD004', 'Long Sleeve Tshirt', 'Polyester', 'Medium', 'White', 100, 'IM004'),
('PD005', 'Hoodies', 'Cotton', 'Large', 'Green', 150, 'IM005');




INSERT INTO Inventory_Manager (InventoryManager_ID, User_name, Name, Email, Password) VALUES
('IM001', 'lakmalp', 'Lakmal Perera', 'lakmal.perera@example.lk', 'password123'),
('IM002', 'nadeeshaf', 'Nadeesha Fernando', 'nadeesha.fernando@example.lk', 'password456'),
('IM003', 'tharindus', 'Tharindu Silva', 'tharindu.silva@example.lk', 'password789'),
('IM004', 'dilshanj', 'Dilshan Jayasinghe', 'dilshan.jayasinghe@example.lk', 'password101'),
('IM005', 'chamariw', 'Chamari Wijesinghe', 'chamari.wijesinghe@example.lk', 'password202');


INSERT INTO Supplier (Supplier_ID, Supplier_Name, Phone_Number, Email, Company_Name, Category, Supply, InventoryManager_ID) VALUES
('SP001', 'ABC Supplies', '0112345678', 'contact@abcsupplies.lk', 'ABC Pvt Ltd', 'Electronics', 'Laptops, Smartphones', 'IM001'),
('SP002', 'XYZ Traders', '0118765432', 'info@xyztraders.lk', 'XYZ Traders Ltd', 'Furniture', 'Chairs, Desks', 'IM002'),
('SP003', 'PQR Distributors', '0113456789', 'sales@pqrdistributors.lk', 'PQR Distributors', 'Stationery', 'Notebooks, Pens', 'IM003'),
('SP004', 'LMN Enterprises', '0119876543', 'support@lmnenterprises.lk', 'LMN Enterprises Ltd', 'Electronics', 'Monitors, Keyboards', 'IM004'),
('SP005', 'OPQ Suppliers', '0114567890', 'service@opqsuppliers.lk', 'OPQ Suppliers Ltd', 'Furniture', 'Sofas, Tables', 'IM005');


INSERT INTO Report (Report_ID, Title, Start_date, End_date, Type, Date, InventoryManager_ID) VALUES
('R001', 'Monthly Sales Report', '2024-09-01', '2024-09-30', 'Sales', '2024-10-01', 'IM001'),
('R002', 'Inventory Audit Report', '2024-09-01', '2024-09-30', 'Audit', '2024-10-02', 'IM002'),
('R003', 'Quarterly Performance Report', '2024-07-01', '2024-09-30', 'Performance', '2024-10-03', 'IM003'),
('R004', 'Supplier Evaluation Report', '2024-09-01', '2024-09-30', 'Evaluation', '2024-10-04', 'IM004'),
('R005', 'Annual Financial Report', '2024-01-01', '2024-12-31', 'Financial', '2024-10-05', 'IM005');


-- Insert entries into Supplier_Inventory
INSERT INTO Supplier_Inventory (Supplier_ID, Product_ID) VALUES
('SP001', 'PD001'),
('SP002', 'PD001'),
('SP003', 'PD001'),
('SP004', 'PD001'),
('SP005', 'PD001');

-- Insert entries into Customer_account_Phone_no
INSERT INTO Customer_account_Phone_no (Customer_ID, Phone_no) VALUES
('C001', 94771234567),
('C002', 94772345678),
('C003', 94773456789),
('C004', 94774567890),
('C005', 94775678901);

-- Insert entries into Customer_support_Phone_no
INSERT INTO Customer_support_Phone_no (Customersupport_ID, Phone_no) VALUES
('CS001', 94771234567),
('CS002', 94772345678),
('CS003', 94773456789),
('CS004', 94774567890),
('CS005', 94775678901);

-- Insert entries into Inquiries_Phone_no
INSERT INTO Inquiries_Phone_no (Inquiry_ID, Phone) VALUES
('I001', 94771234567),
('I002', 94772345678),
('I003', 94773456789),
('I004', 94774567890),
('I005', 94775678901);
