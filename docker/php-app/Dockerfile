FROM php:8.2.5-fpm as base

RUN apt-get update; \
    apt-get install -y --no-install-recommends unzip git;

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/
RUN install-php-extensions pdo_mysql pdo_pgsql intl
RUN docker-php-ext-install bcmath

RUN ln -sf /usr/share/zoneinfo/Europe/Moscow /etc/localtime

ARG USER_ID
RUN groupadd --gid "$USER_ID" dev \
    && useradd --uid "$USER_ID" --gid dev --shell /bin/bash --create-home dev

#RUN #su dev -c 'mkdir -p /home/dev/.composer/ /home/dev/app/'
#RUN #mkdir /app/var/xdebug; chmod 777 /app/var/xdebug
RUN pecl install xdebug && docker-php-ext-enable xdebug
COPY conf.d/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

COPY www.conf /usr/local/etc/php-fpm.d/www.conf

RUN su dev -c 'mkdir -p /home/dev/.composer/ /home/dev/app/'

USER dev

WORKDIR /app/
