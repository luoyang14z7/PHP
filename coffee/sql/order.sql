SET NAMES UTF8;
USE coffee;
CREATE TABLE orderlist(
    oid INT PRIMARY KEY AUTO_INCREMENT,
    uid INT,
    oname VARCHAR(32),
    ophone VARCHAR(64),
    oaddress VARCHAR(64),
    opay VARCHAR(32),
    oprice INT,
    otime BIGINT,
    ostate VARCHAR(32)
);