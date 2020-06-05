CREATE USER 'ushakiran'@'%' IDENTIFIED BY 'kiran';
GRANT ALL PRIVILEGES ON *.* TO 'ushakiran'@'%' WITH GRANT OPTION;
ALTER USER 'ushakiran'@'%' IDENTIFIED WITH mysql_native_password BY 'kiran';
FLUSH PRIVILEGES;