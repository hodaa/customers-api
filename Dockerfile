#FROM php:7-apache

#RUN apt-get update -y && apt-get install -y libpng-dev curl libcurl4-openssl-dev

#RUN docker-php-ext-install pdo pdo_mysql gd curl

#RUN a2enmod rewrite
#RUN service apache2 restart

#RUN rm -f /etc/apache2/sites-available/000-default.conf
#ADD ./000-default.conf /etc/apache2/sites-available

#RUN ln -s /etc/apache2/sites-available/000-default.conf /etc/apache2/sites-enabled/000-default.conf