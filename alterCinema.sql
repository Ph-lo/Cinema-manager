CREATE TABLE admins 
( 
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT, 
    login VARCHAR(100), pass TEXT
);

INSERT INTO admin (login, pass) 
    VALUES ('admin', '$2y$10$z8ZjgcfC8.JXmDgpZAXK3eSE..6oTGq/ucN.YradGunlHvPTr5d32');