CREATE DATABASE integradora;
USE integradora;
DROP TABLE IF EXISTS roles;

DROP TABLE IF EXISTS users;
CREATE TABLE users(
  id int NOT NULL PRIMARY KEY auto_increment,
  role enum('user','admin') NOT NULL,
  username varchar(255) NOT NULL,
  password varchar(255) NOT NULL,
  name varchar(255) NOT NULL
);



DROP TABLE IF EXISTS category_tenis;
CREATE TABLE category_tenis (
	id INT PRIMARY KEY,
	name VARCHAR(180) NOT NULL UNIQUE,
	created_at TIMESTAMP(0) NOT NULL
);

DROP TABLE IF EXISTS tenis;
CREATE TABLE tenis(
	id INT PRIMARY KEY,
	name VARCHAR(180) NOT NULL UNIQUE,
	description VARCHAR(255) NOT NULL,
	price DECIMAL DEFAULT 0,
	id_category INT NOT NULL,
	talla VARCHAR (50) NOT NULL,
	created_at TIMESTAMP(0) NOT NULL,
	FOREIGN KEY(id_category) REFERENCES category_tenis(id) ON UPDATE CASCADE ON DELETE CASCADE
);

DROP TABLE IF EXISTS orders;
CREATE TABLE orders(
	id INT PRIMARY KEY,
	id_client INT NOT NULL,
	status VARCHAR(90) NOT NULL,
	timestamp INT NOT NULL,
	created_at TIMESTAMP(0) NOT NULL,
	FOREIGN KEY(id_client) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE
);
DROP TABLE IF EXISTS orders_has_products;
CREATE TABLE orders_has_products(
	id_order INT NOT NULL,
	id_product INT NOT NULL,
	quantity INT NOT NULL,
	created_at TIMESTAMP(0) NOT NULL,
	PRIMARY KEY(id_order, id_product),
	FOREIGN KEY(id_order) REFERENCES orders(id) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY(id_product) REFERENCES tenis(id) ON UPDATE CASCADE ON DELETE CASCADE
);