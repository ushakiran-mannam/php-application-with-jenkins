FROM ubuntu:18.04
RUN apt-get update
RUN apt-get install -y apache2
RUN DEBIAN_FRONTEND=noninteractive apt-get install -y php libapache2-mod-php php-mysql php7.2-mysqli
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf 
COPY index.php /var/www/html/sample.php
CMD apachectl -D FOREGROUND