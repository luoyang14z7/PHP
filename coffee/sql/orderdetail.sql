SET NAMES UTF8;
USE coffee;
CREATE TABLE orderdetail(
    opid INT PRIMARY KEY AUTO_INCREMENT,
    oid INT,
    pid INT,
    count INT
)