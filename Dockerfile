FROM debian:bullseye-slim

# 1. NGINX Unit + PHP 7.4 (Docker Hub no longer publishes unit:*-php7.x images,
# so Unit and its PHP module are installed from NGINX's apt repo, which pairs
# with Debian Bullseye's native PHP 7.4 as required by this app's composer.json).
RUN apt update && apt install -y --no-install-recommends \
    curl ca-certificates gnupg2 lsb-release apt-transport-https unzip git \
    && curl -o /usr/share/keyrings/nginx-keyring.gpg https://unit.nginx.org/keys/nginx-keyring.gpg \
    && echo "deb [signed-by=/usr/share/keyrings/nginx-keyring.gpg] https://packages.nginx.org/unit/debian/ bullseye unit" \
        > /etc/apt/sources.list.d/unit.list \
    && apt update && apt install -y --no-install-recommends \
        unit unit-php \
        php7.4-cli php7.4-common php7.4-mysql php7.4-intl php7.4-zip \
        php7.4-gd php7.4-bcmath php7.4-mbstring php7.4-xml php7.4-curl \
        php7.4-dev php-pear gcc make autoconf libc-dev pkg-config \
    && pecl install redis \
    && echo "extension=redis.so" > /etc/php/7.4/mods-available/redis.ini \
    && phpenmod -v 7.4 redis \
    && apt purge -y gcc make autoconf libc-dev pkg-config php-pear php7.4-dev \
    && apt autoremove -y \
    && rm -rf /var/lib/apt/lists/*

RUN echo "opcache.enable=1" > /etc/php/7.4/mods-available/custom.ini \
    && echo "memory_limit=512M" >> /etc/php/7.4/mods-available/custom.ini \
    && echo "upload_max_filesize=64M" >> /etc/php/7.4/mods-available/custom.ini \
    && echo "post_max_size=64M" >> /etc/php/7.4/mods-available/custom.ini \
    && echo "max_execution_time=300" >> /etc/php/7.4/mods-available/custom.ini \
    && phpenmod -v 7.4 custom

COPY --from=composer:1 /usr/bin/composer /usr/local/bin/composer

WORKDIR /var/www/sidepej

RUN mkdir -p /var/www/sidepej/storage /var/www/sidepej/bootstrap/cache

COPY . .

RUN composer install --prefer-dist --optimize-autoloader --no-interaction

RUN chown -R unit:unit /var/www/sidepej/storage /var/www/sidepej/bootstrap/cache \
    && chmod -R 775 /var/www/sidepej/storage /var/www/sidepej/bootstrap/cache

COPY unit.json /docker-entrypoint.d/unit.json
COPY docker/docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

COPY .env.example .env
# RUN php artisan key:generate

EXPOSE 8000

ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]
CMD ["unitd", "--no-daemon"]
