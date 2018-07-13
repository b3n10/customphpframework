DROP DATABASE IF EXISTS mvclogin;

CREATE DATABASE mvclogin;

USE mvclogin;

CREATE USER 'mvcuser'@'%' IDENTIFIED BY 'jairah'; GRANT ALL PRIVILEGES ON `mvclogin`.* TO 'mvcuser'@'%';
