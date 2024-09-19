CREATE TABLE customer (
    customer_id_num INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    firstname varchar(255),
    lastname varchar(255) NOT NULL,
    email varchar(255) NOT NULL,
    password varchar(255) NOT NULL,
    address varchar(255),
    phone_no varchar(255),
    dob DATE,
    date_created DATE DEFAULT CURRENT_DATE
);




-- to change name of thr column
ALTER TABLE customer CHANGE customer_id_num customer_id INT AUTO_INCREMENT;
