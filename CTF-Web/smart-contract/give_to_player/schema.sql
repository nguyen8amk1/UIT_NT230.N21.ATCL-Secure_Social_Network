CREATE DATABASE IF NOT EXISTS dbz;
USE dbz;

CREATE TABLE IF NOT EXISTS users (
	username varchar(255),
	password varchar(255) NOT NULL,
	balance decimal(25,0),
	PRIMARY KEY (username)
);

CREATE TABLE IF NOT EXISTS items (
	id int AUTO_INCREMENT,
	name varchar(255),
	content varchar(255),
	price decimal(25, 0),
	PRIMARY KEY (id)
);

INSERT INTO items(name, content, price) VALUES ('Flag', 'flag{REDACTED}', 18446744073709551616);
INSERT INTO items(name, content, price) VALUES ('Chopper', 'Tony Tony Choppẻ gives you a hug <3', 1);
INSERT INTO items(name, content, price) VALUES ('Tony Buoi Sang', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 6969);
