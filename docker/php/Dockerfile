FROM php:8.1-fpm

ARG UID

# Create user and some useful stuff
RUN adduser -u ${UID} --disabled-password --gecos "" appuser
RUN mkdir /home/appuser/.ssh
RUN chown -R appuser:appuser /home/appuser/
RUN echo "StrictHostKeyChecking no" >> /home/appuser/.ssh/config
RUN echo "export COLUMNS=300" >> /home/appuser/.bashrc
RUN echo "alias sf=/appdata/www/bin/console" >> /home/appuser/.bashrc

# Copy PHP config file
COPY ./php.ini /usr/local/etc/php/php.ini

RUN apt update
RUN apt install -y git acl openssl openssh-client wget zip vim libssh-dev
RUN apt install -y libpng-dev zlib1g-dev libzip-dev libxml2-dev libicu-dev
RUN docker-php-ext-install intl pdo pdo_mysql zip gd soap bcmath sockets
RUN pecl install xdebug
RUN docker-php-ext-enable --ini-name 05-opcache.ini opcache xdebug

# Install and update composer
RUN curl https://getcomposer.org/composer.phar -o /usr/bin/composer && chmod +x /usr/bin/composer
RUN composer self-update

# Copy XDEBUG config file
COPY xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

# Create working directory
RUN mkdir -p /appdata/www
USER appuser
WORKDIR /appdata/www
