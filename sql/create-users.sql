USE mvclogin;

CREATE TABLE users (
	id						int						AUTO_INCREMENT PRIMARY KEY,
	name					varchar(50),
	email					varchar(255)	UNIQUE,
	password_hash	varchar(255)
);

-- postgres --
-- CREATE TABLE users (
-- 	id						SERIAL PRIMARY KEY,
-- 	name					VARCHAR(50),
-- 	email					VARCHAR(255),
-- 	password_hash VARCHAR(255),
-- 	UNIQUE(email)
-- );
