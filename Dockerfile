FROM alpine:latest

ENV S6_URL https://github.com/just-containers/s6-overlay/releases/download/v2.0.0.1/s6-overlay-amd64.tar.gz
ENV S6_SHA256SUM df235428444be7737caf363e5dcfb58e3022fa611f5a27fe309ecd6fc1755cda

ENV APP_ENV production
ENV APP_DEBUG false
ENV PATH="/app:${PATH}"

# Change S6 behaviour so stage when STAGE2 fails the container will exit
ENV S6_BEHAVIOUR_IF_STAGE2_FAILS 2

# Create and switch to /app work directory and also copy all the necessary files into context
WORKDIR /app
COPY . /app
COPY ./container-data /

RUN set -eux \
    && apk add --no-cache --virtual .run-deps \
        nginx \
        bash \
        dcron \
        php7 \
        php7-fpm \
        php7-json \
        php7-session \
        php7-zip \
        php7-curl \
        php7-xml \
        php7-simplexml \
        php7-xmlwriter \
        php7-calendar \
        php7-fileinfo \
        php7-tokenizer \
        php7-dom \
        php7-pdo_mysql \
    && apk add --no-cache --virtual .build-deps \
        git \
        nodejs \
        npm \
        zip \
        composer \
    && npm install -g yarn \
    && composer install --no-dev -o \
    && artisan budget:install \
    && rm .env \
    && find /app/storage -type d -print0 > /app/storage.txt \
    && chown -R nginx.nginx /app \
    && wget "$S6_URL" -O /tmp/s6-overlay-amd64.tar.gz \
    && echo "$S6_SHA256SUM  /tmp/s6-overlay-amd64.tar.gz" | sha256sum -c \
    && tar xzf /tmp/s6-overlay-amd64.tar.gz -C / \
    && sed -i 's/user = nobody/user = nginx/g' /etc/php7/php-fpm.d/www.conf \
    && sed -i 's/group = nobody/group = nginx/g' /etc/php7/php-fpm.d/www.conf \
    && sed -i 's/;clear_env = no/clear_env = no/g' /etc/php7/php-fpm.d/www.conf \
    && mkdir /run/nginx \
    && ln -s /dev/stderr /var/log/nginx/error.log \
    && ln -s /dev/stdout /var/log/nginx/access.log \
    && npm uninstall -g yarn \
    && apk del .build-deps \
    && rm -rf \
        /tmp/* \
        /root/.npm \
        /root/.composer \
        /app/node_modules \
        /usr/local/share/.cache/yarn

ENTRYPOINT ["/docker-entrypoint.sh"]
