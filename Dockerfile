FROM php:8.3-apache
RUN apt-get update && apt-get install -y --no-install-recommends libsqlite3-dev \
    && docker-php-ext-install pdo_sqlite \
    && rm -rf /var/lib/apt/lists/*
WORKDIR /var/www
COPY db/ /var/www/db/
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
COPY . /var/www/html/
RUN mkdir -p /var/www/data && rm -rf /var/www/html/db /var/www/html/docs /var/www/html/.git
ENV DB_PATH=/var/www/data/app.sqlite
EXPOSE 80
ENTRYPOINT ["docker-entrypoint.sh"]
