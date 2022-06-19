DROP DATABASE IF EXISTS `multimax`;
CREATE DATABASE IF NOT EXISTS `multimax` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `multimax`;
CREATE TABLE IF NOT EXISTS `User` (
    ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Email VARCHAR(320) NOT NULL,
    Token VARCHAR(32) NOT NULL,
    Access INT NOT NULL DEFAULT 0,
    IDReferal INT,
    Created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    Edited TIMESTAMP,
    ISDeleted BOOLEAN NOT NULL DEFAULT 0
);
INSERT INTO `User` (Email,Token,Access) VALUES ('email','5830ba1632a5abdb465fb9637f11a20a',0),('admin@email.com','abf5142836a4bef816a18766423773c5',0)
CREATE TABLE IF NOT EXISTS `Type` (
    ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Title VARCHAR(50) NOT NULL,
    ISDeleted BOOLEAN NOT NULL DEFAULT 0
);
INSERT INTO `Type` (Title) VALUES ('bot'),('server');
CREATE TABLE IF NOT EXISTS `Status` (
    ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Title VARCHAR(50) NOT NULL,
    ISDeleted BOOLEAN NOT NULL DEFAULT 0
);
INSERT INTO `Status` (Title) VALUES ('offline'),('online');
CREATE TABLE IF NOT EXISTS `Product` (
    ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    IDType INT NOT NULL DEFAULT 1,
    PreviewImage VARCHAR(1000),
    Title VARCHAR(50) NOT NULL,
    Description VARCHAR(1000),
    Price DECIMAL(10,2) NOT NULL DEFAULT 0,
    Active BOOLEAN NOT NULL DEFAULT 1,
    Discount DECIMAL(10,2) DEFAULT 0,
    GuideLink VARCHAR(1000),
    Created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    Edited TIMESTAMP,
    ISDeleted BOOLEAN NOT NULL DEFAULT 0,
    FOREIGN KEY (IDType) REFERENCES `Type` (ID)
);
CREATE TABLE IF NOT EXISTS `Order` (
    ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    IDUser INT NOT NULL,
    Created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    Edited TIMESTAMP,
    ISDeleted BOOLEAN NOT NULL DEFAULT 0,
    FOREIGN KEY (IDUser) REFERENCES `User` (ID)
);
CREATE TABLE IF NOT EXISTS `OrderProduct` (
    ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    IDOrder INT NOT NULL,
    IDProduct INT NOT NULL,
    Count INT NOT NULL DEFAULT 1,
    Price INT NOT NULL,
    IDStatus INT NOT NULL DEFAULT 1,
    DownloadLink VARCHAR(1000),
    FOREIGN KEY (IDOrder) REFERENCES `Order` (ID),
    FOREIGN KEY (IDProduct) REFERENCES `Product` (ID),
    FOREIGN KEY (IDStatus) REFERENCES `Status` (ID)
);
CREATE TABLE IF NOT EXISTS `Referal` (
    ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    IDUser INT NOT NULL,
    Url VARCHAR(1000) NOT NULL,
    ISDeleted BOOLEAN NOT NULL DEFAULT 0,
    FOREIGN KEY (IDUser) REFERENCES `User` (ID)
);
ALTER TABLE `User` ADD CONSTRAINT FOREIGN KEY(IDReferal) REFERENCES `Referal` (ID);
CREATE TABLE IF NOT EXISTS `Feedback` (
    ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    IDUser INT NOT NULL,
    Message VARCHAR(1000) NOT NULL,
    ISDeleted BOOLEAN NOT NULL DEFAULT 0,
    FOREIGN KEY (IDUser) REFERENCES `User` (ID)
);

INSERT INTO `Product` (IDType,Title,Description,Price,Discount) VALUES
(1,'CLICKER1','This bot is required to perform repetitive work in the Dolphin browser when using multi-accounts',180,DEFAULT),
(1,'CLICKER2','This bot is required to perform repetitive work in the Dolphin browser when using multi-accounts',250,DEFAULT),
(1,'CLICKER3','This bot is required to perform repetitive work in the Dolphin browser when using multi-accounts',350,DEFAULT),
(1,'CLICKER4','This bot is required to perform repetitive work in the Dolphin browser when using multi-accounts',280,DEFAULT),
(1,'CLICKER5','This bot is required to perform repetitive work in the Dolphin browser when using multi-accounts',150,DEFAULT),
(1,'CLICKER6','This bot is required to perform repetitive work in the Dolphin browser when using multi-accounts',450,DEFAULT),
(1,'BOT','This bot is required to perform repetitive work in the Dolphin browser when using multi-accounts',280,DEFAULT),
(1,'BOT2','This bot is required to perform repetitive work in the Dolphin browser when using multi-accounts',150,DEFAULT),
(1,'BOT3','This bot is required to perform repetitive work in the Dolphin browser when using multi-accounts',450,DEFAULT);
