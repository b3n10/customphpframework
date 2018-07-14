USE mvclogin;

CREATE TABLE users (
	id						int						AUTO_INCREMENT PRIMARY KEY,
	name					varchar(50),
	email					varchar(255)	UNIQUE,
	password_hash	varchar(255)
);
