-- Minh Nguyen
-- 11/9/2014
--Assignment 2 definition.sql 


-- For part one of this assignment you are to make a database with the following specifications and run the following queries
-- The drop table queries below are to facilitate testing on my end

DROP TABLE IF EXISTS `os_support`;
DROP TABLE IF EXISTS `device`;
DROP TABLE IF EXISTS `operating_system`;
DROP TABLE IF EXISTS `category_tbl`;


-- Create a table called category_tbl with the following properties:
-- id - an auto incrementing integer which is the primary key
-- name - a varchar with a maximum length of 255 characters, cannot be null
-- subcategory - a varchar with a maximum length of 255 characters
-- the combinatino of a name and subcategory must be unique

CREATE TABLE category_tbl (
  id INT AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  subcategory VARCHAR(255), 
  CONSTRAINT `unq_nameSub` UNIQUE (name, subcategory),
  PRIMARY KEY(id))
  ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- Create a table called operating_system with the following properties:
-- id - an auto incrementing integer which is the primary key
-- name - a varchar of maximum length 255, cannot be null
-- version - a varchar of maximum length 255, cannot be null
-- name version combinations must be unique

CREATE TABLE operating_system (
  id INT AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  version VARCHAR(255) NOT NULL, 
  CONSTRAINT `unq_nameVersion` UNIQUE (name, version),
  PRIMARY KEY(id))
  ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- Create a table called device with the following properties:
-- id - an auto incrementing integer which is the primary key
-- cid - an integer which is a foreign key reference to the category_tbl table
-- name - a varchar of maximum length 255 which cannot be null
-- received - a date type (you can read about it here http://dev.mysql.com/doc/refman/5.0/en/datetime.html)
-- isbroken - a boolean

CREATE TABLE device (
  id INT AUTO_INCREMENT,
  cid INT(255) NOT NULL,
  name VARCHAR(255) NOT NULL, 
  received date,
  isbroken BOOLEAN,
  CONSTRAINT `fk_cate_id` FOREIGN KEY (cid) REFERENCES category_tbl (id),
  PRIMARY KEY(id))
  ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- Create a table called os_support with the following properties, this is a table representing a many-to-many relationship
-- between devices and operating systems:
-- did - an integer which is a foreign key reference to device
-- osid - an integer which is a foreign key reference to operating_system
-- notes - a text type
-- The primary key is a combination of did and osid

CREATE TABLE os_support (
  did INT,
  osid INT,
  notes TEXT, 
  CONSTRAINT `fk_did` FOREIGN KEY (did) REFERENCES device (id),
  CONSTRAINT `fk_osid` FOREIGN KEY (osid) REFERENCES operating_system (id),
  PRIMARY KEY(did, osid))
  ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- insert the following into the category_tbl table:
-- name: phone
-- subcategory: NULL
INSERT INTO category_tbl (name, subcategory)
VALUES ('phone', NULL);

-- name: phone
-- subcategory: maybe a tablet?
INSERT INTO category_tbl (name, subcategory)
VALUES ('phone', 'maybe a tablet');

-- name: tablet
-- subcategory: but kind of a laptop
INSERT INTO category_tbl (name, subcategory)
VALUES ('tablet', 'but kind of a laptop');

-- name: tablet
-- subcategory: ereader
INSERT INTO category_tbl (name, subcategory)
VALUES ('tablet', 'ereader');


-- insert the folowing into the operating_system table:
-- name: Android
-- version: 1.0
INSERT INTO operating_system (name, version)
VALUES ('Android', '1.0');

-- name: Android
-- version: 2.0
INSERT INTO operating_system (name, version)
VALUES ('Android', '2.0');

-- name: iOS
-- version: 4.0
INSERT INTO operating_system (name, version)
VALUES ('iOS', '4.0');


-- insert the following devices instances into the device table (you should use a subquery to set up foriegn keys referecnes, no hard coded numbers):
-- cid - reference to name: phone subcategory: 'maybe a tablet'
-- name - Samsung Atlas
-- received - 1/2/1970
-- isbroken - True
INSERT INTO device (cid, name, received, isbroken)
SELECT id, 'Samsung Atlas', 1/2/1970, TRUE
FROM category_tbl WHERE (name = 'phone' AND subcategory = 'maybe a tablet');


-- cid - reference to name: phone subcategory: NULL
-- name - Nokia
-- received - 5/6/1999
-- isbroken - False
INSERT INTO device (cid, name, received, isbroken)
SELECT id, 'Nokia', 5/6/1999, FALSE
FROM category_tbl WHERE (name = 'phone' AND subcategory IS NULL);

-- cid - reference to name: tablet subcategory: ereader
-- name - jPad
-- received - 11/18/2005
-- isbroken - False
INSERT INTO device (cid, name, received, isbroken)
SELECT id, 'jPad', 11/18/2005, FALSE
FROM category_tbl WHERE (name = 'tablet' AND subcategory = 'ereader');



-- insert the following into the os_support table using subqueries to look up data as needed:
-- device: Samsung Atlas
-- os: Android 1.0
-- notes: Works poorly
INSERT INTO os_support (did, osid, notes)
SELECT device.id, operating_system.id, 'Works poorly'
FROM device, operating_system
WHERE (device.name = "Samsung Atlas" And operating_system.name = "Android" AND version = "1.0");


-- device: Samsung Atlas
-- os: Android 2.0
-- notes: 
INSERT INTO os_support (did, osid, notes)
SELECT device.id, operating_system.id, ""
FROM device, operating_system
WHERE (device.name = "Samsung Atlas" And operating_system.name = "Android" AND version = "2.0");

-- device: jPad
-- os: iOS 4.0
-- notes: 
INSERT INTO os_support (did, osid, notes)
SELECT device.id, operating_system.id, ""
FROM device, operating_system
WHERE (device.name = "jPad" And operating_system.name = "iOS" AND version = "4.0");

