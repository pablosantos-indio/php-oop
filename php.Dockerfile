FROM node:latest AS node
FROM php:8.2-apache

COPY --from=node /usr/local/lib/node_modules /usr/local/lib/node_modules
COPY --from=node /usr/local/bin/node /usr/local/bin/node
RUN ln -s /usr/local/lib/node_modules/npm/bin/npm-cli.js /usr/local/bin/npm

RUN apt-get update && apt-get install -y libicu-dev git zip \
    && pecl install xdebug \
    && docker-php-ext-install pdo pdo_mysql mysqli \
	  && docker-php-ext-enable xdebug \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl \
    && a2enmod rewrite

ARG UID
ARG GID

ENV UID=${UID}
ENV GID=${GID}

RUN groupadd -g ${GID} php && \
    useradd -g php -u ${UID} -s /bin/sh -m php

RUN sed -i 's/export APACHE_RUN_USER=www-data/export APACHE_RUN_USER=php/g' /etc/apache2/envvars
RUN sed -i 's/export APACHE_RUN_GROUP=www-data/export APACHE_RUN_GROUP=php/g' /etc/apache2/envvars

##### commands for installing mhsendmail to use mailhog for local testing ##########
# download mhsendmail (for mailhog) and configure sendmail_path to use mhsendmail - this is only used for php mail function on local
RUN curl -LkSso /usr/bin/mhsendmail 'https://github.com/mailhog/mhsendmail/releases/download/v0.2.0/mhsendmail_linux_amd64'&& \
    chmod 0755 /usr/bin/mhsendmail && \
    echo 'sendmail_path = "/usr/bin/mhsendmail --smtp-addr=mailhog:1025"' > /usr/local/etc/php/php.ini;

USER php

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
