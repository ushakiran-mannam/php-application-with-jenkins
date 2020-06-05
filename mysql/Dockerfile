FROM mysql/mysql-server:5.7
COPY create_user.sql /docker-entrypoint-initdb.d/
COPY simple_db_script.sql /docker-entrypoint-initdb.d/