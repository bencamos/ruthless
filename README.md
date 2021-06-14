![image](https://user-images.githubusercontent.com/85905323/121963468-7e7ba200-cdad-11eb-9497-2bdd48d161bf.png)
![image](https://user-images.githubusercontent.com/85905323/121963496-863b4680-cdad-11eb-965e-5c20e20a7fda.png)




Database Setup.

```
CREATE TABLE planTypes (
  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(50) NOT NULL UNIQUE,
  taskLimit INT NOT NULL,
  expiry VARCHAR(255) NOT NULL,
  description VARCHAR(255) NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE passwordResets (
  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  email VARCHAR(50) NOT NULL UNIQUE,
  authcode VARCHAR(255) NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE proxies (
  id1 INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  id INT NOT NULL,
  group1 VARCHAR(50) NOT NULL,
  type VARCHAR(255) NOT NULL,
  proxies VARCHAR(255) NOT NULL,
  online INT NOT NULL,
  offline INT NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE accounts (
  id1 INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  id INT NOT NULL,
  website VARCHAR(50) NOT NULL,
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE payments (
  id1 INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  id INT NOT NULL,
  number VARCHAR(50) NOT NULL,
  expiry VARCHAR(255) NOT NULL,
  cvv VARCHAR(255) NOT NULL,
  name VARCHAR(255) NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE address (
  id1 INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  id INT NOT NULL,
  street VARCHAR(50) NOT NULL,
  city VARCHAR(255) NOT NULL,
  state VARCHAR(255) NOT NULL,
  zip VARCHAR(255) NOT NULL,
  mobile VARCHAR(255) NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE users (
  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE userPlans (
  id1 INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  id INT NOT NULL UNIQUE,
  plan VARCHAR(255) NOT NULL,
  expiry VARCHAR(255) NOT NULL,
  runningTasks INT NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE tasks (
  taskID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  id INT NOT NULL,
  status VARCHAR(255) NOT NULL,
  website VARCHAR(255) NOT NULL,
  productKeyWords VARCHAR(255) NOT NULL,
  productLink VARCHAR(255) NOT NULL,
  proxy VARCHAR(255) NOT NULL,
  payment VARCHAR(255) NOT NULL,
  quantity VARCHAR(255) NOT NULL,
  variant VARCHAR(255) NOT NULL,
  account VARCHAR(255) NOT NULL,
  shipping VARCHAR(255) NOT NULL,
  billing VARCHAR(255) NOT NULL,
  exectime VARCHAR(255) NOT NULL,
  success VARCHAR(255) NOT NULL,
  fail VARCHAR(255) NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
ALTER TABLE
  users
ADD
  email varchar(255);
ALTER TABLE
  users ALTER email
SET
  DEFAULT 'null';
UPDATE
  `users`
SET
  `email` = "null"
WHERE
  `email` is null;
ALTER TABLE
  users
MODIFY
  COLUMN email VARCHAR(255)
AFTER
  password;
ALTER TABLE
  tasks
ADD
  product varchar(255);
ALTER TABLE
  tasks ALTER product
SET
  DEFAULT 'null';
UPDATE
  `tasks`
SET
  `product` = "null"
WHERE
  `product` is null;
ALTER TABLE
  tasks
MODIFY
  COLUMN product VARCHAR(255)
AFTER
  website;
INSERT INTO
  planTypes (name, taskLimit, expiry, description)
VALUES
  (
    "admin",
    999999,
    "99999999999999999999999",
    "Administrator plan.  Lasts forever and has infinite task cap."
  )

```
