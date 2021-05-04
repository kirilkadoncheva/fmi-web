CREATE TABLE PRODUCTS ( 
	ID INT NOT NULL PRIMARY KEY, 
	PRODUCT_NAME VARCHAR(160) NOT NULL, 
	QUANTITY FLOAT NOT NULL CHECK (QUANTITY >= 0) 
);