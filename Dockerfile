FROM php:8.1-apache
 
RUN a2enmod rewrite
 
RUN apt-get update \
  && apt-get install -y libzip-dev git wget zlib1g-dev libicu-dev g++ --no-install-recommends \
  && docker-php-ext-configure intl && docker-php-ext-install intl \
  && apt-get clean \
  && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*
 
RUN docker-php-ext-install pdo mysqli pdo_mysql zip;
 
RUN wget https://getcomposer.org/download/2.4.1/composer.phar \
    && mv composer.phar /usr/bin/composer && chmod +x /usr/bin/composer
 
COPY docker/apache.conf /etc/apache2/sites-enabled/000-default.conf
COPY docker/entrypoint.sh /entrypoint.sh
COPY . /var/www
 
WORKDIR /var/www

RUN chmod +x /entrypoint.sh
 
CMD ["apache2-foreground"]
ENTRYPOINT ["/entrypoint.sh"]