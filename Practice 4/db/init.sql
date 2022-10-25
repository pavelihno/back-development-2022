CREATE DATABASE IF NOT EXISTS appDB;
CREATE USER IF NOT EXISTS 'user'@'%' IDENTIFIED BY 'password';
GRANT SELECT,UPDATE,INSERT ON appDB.* TO 'user'@'%';
FLUSH PRIVILEGES;

USE appDB;

CREATE TABLE users (
  ID INT(11) NOT NULL AUTO_INCREMENT,
  login VARCHAR(20) NOT NULL,
  password VARCHAR(255) NOT NULL,
  PRIMARY KEY (ID)
);

CREATE TABLE drinks (
  ID INT(11) NOT NULL AUTO_INCREMENT,
  title VARCHAR(30) NOT NULL,
  price INT(10) NOT NULL,
  PRIMARY KEY (ID)
);

CREATE TABLE desserts (
  ID INT(11) NOT NULL AUTO_INCREMENT,
  title VARCHAR(30) NOT NULL,
  calories INT(10) NOT NULL,
  price INT(10) NOT NULL,
  PRIMARY KEY (ID)
);

INSERT INTO users (login, password) VALUES
-- pasavinov 12345678
('pasavinov', '{SHA}fCIvspJ9goryL1khNOiTJIBjfA0=');

INSERT INTO drinks (title, price) VALUES
('Latte', 320),
('Cappuccino', 280),
('Espresso', 180),
('Tea', 120),
('Cocoa', 150),
('Hot chocolate', 210);

INSERT INTO desserts (title, calories, price) VALUES
('Cheesecake New York', 325, 125),
('Croissant with stuffing', 230, 80),
('Tiramisu', 280, 140),
('Chocolate fondant', 395, 150),
('Muffin', 290, 75);