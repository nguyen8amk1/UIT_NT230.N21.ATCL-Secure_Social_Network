CREATE DATABASE IF NOT EXISTS dbz;
USE dbz;

CREATE TABLE IF NOT EXISTS users (
	username varchar(255),
	password varchar(255) NOT NULL,
	premium BOOL NOT NULL DEFAULT 0,
	PRIMARY KEY (username)
);
