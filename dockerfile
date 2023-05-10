FROM php:8.1.0-apache

RUN mkdir -p /var/www/html

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    unzip \
    libzip-dev \
    zip \
    libicu-dev \
    libxml2-dev \
    libonig-dev
RUN docker-php-ext-install pdo mbstring
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install intl
# RUN docker-php-ext-configure zip
RUN docker-php-ext-install zip
# Enable Apache mod_rewrite
RUN a2enmod rewrite
RUN apt-get install nano
# Update the default apache site with the config we created.

COPY . .
ENV COMPOSER_ALLOW_SUPERUSER 1
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN echo $PATH
RUN ls /var/www/html
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 775 /var/www/html
RUN rm -f .env.local
RUN rm -f .env.test
RUN ls /var/www/html
#RUN chmod -R 777 /var/www/html/var
#RUN rm -rf /var/www/html/vendor
RUN php composer.phar install
RUN chmod -R 777 /var/www/html/var
ADD ./docker/symfony.conf /etc/apache2/sites-available/symfony.conf
ADD ./docker/symfony.conf /etc/apache2/sites-enabled/symfony.conf
ADD ./docker/symfony.conf /etc/apache2/conf-available/symfony.conf
ADD ./docker/symfony.conf /etc/apache2/conf-enabled/symfony.conf
RUN rm -f /etc/apache2/sites-available/000-default.conf
RUN chown root:root ./script.sh
RUN chmod +x ./script.sh
#CMD ["apache2-foreground"]
#CMD ["./script.sh"]
#CMD ["apache2-foreground"]
CMD ["./script.sh"]
RUN chown www-data:www-data ./script.sh
EXPOSE 82
#EXPOSE 82