FROM php:8.2-alpine

WORKDIR /app

COPY entrypoint.sh /

RUN chmod +x /entrypoint.sh

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions @composer openswoole pcntl pdo_pgsql

ENTRYPOINT ["/entrypoint.sh"]