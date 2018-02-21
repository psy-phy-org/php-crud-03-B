CREATE TABLE products (
  id INT(11) AUTO_INCREMENT PRIMARY KEY,
  pname VARCHAR(100) NOT NULL,
  pprice INT(11) NOT NULL,
  pdescription text NOT NULL,
  created DATETIME,
  modified TIMESTAMP
);

