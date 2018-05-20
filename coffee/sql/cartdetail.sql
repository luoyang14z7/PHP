SET NAMES UTF8;
USE coffee;
CREATE TABLE cartdetail(
    did INT PRIMARY KEY AUTO_INCREMENT,
    cartid INT,
    productid INT,
    count INT
)