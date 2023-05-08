FROM php:8.2-fpm

RUN apt-get update \
    && apt-get install -y \
        git \
        zlib1g-dev \
        postgresql-client \
        libpq-dev \
        nano \
        librabbitmq-dev \
        libssh-dev \
        libzip-dev \
        zip \
        unzip \
        libicu-dev \
    && apt-get clean \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && docker-php-ext-configure zip \
    && docker-php-ext-configure intl \
    && docker-php-ext-install \
       zip \
       intl \
       pdo \
       pdo_pgsql \
       bcmath \
       opcache \
    && pecl install apcu \
    && pecl install amqp-1.11.0beta \
    && pecl install xdebug \
    && docker-php-ext-enable amqp \
    && docker-php-ext-enable apcu \
    && docker-php-ext-enable xdebug \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* \

    && touch /usr/local/etc/php/conf.d/custom.ini \
    && echo "memory_limit=4096M;" >> /usr/local/etc/php/conf.d/custom.ini \
    && echo "realpath_cache_size=64M;" >> /usr/local/etc/php/conf.d/custom.ini \
    && echo "realpath_cache_ttl=7200;" >> /usr/local/etc/php/conf.d/custom.ini \
    && echo "upload_max_filesize=505M;" >> /usr/local/etc/php/conf.d/custom.ini \
    && echo "post_max_size=500M;" >> /usr/local/etc/php/conf.d/custom.ini \

    && touch /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.enable=1;" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.revalidate_freq=0;" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.validate_timestamps=1;" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.max_accelerated_files=300000;" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.memory_consumption=512;" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.max_wasted_percentage=10;" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.interned_strings_buffer=64;" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.fast_shutdown=1;" >> /usr/local/etc/php/conf.d/opcache.ini \

    && touch /usr/local/etc/php/conf.d/apcu.ini \
    && echo "apc.enable=1;" >> /usr/local/etc/php/conf.d/apcu.ini \
    && echo "apc.enable_cli=0;" >> /usr/local/etc/php/conf.d/apcu.ini \
    && echo "apc.shm_size=256M;" >> /usr/local/etc/php/conf.d/apcu.ini \
    && echo "apc.mmap_file_mask=/tmp/apc.XXXXXX;" >> /usr/local/etc/php/conf.d/apcu.ini \

    && touch /usr/local/etc/php-fpm.conf \
    && echo "pm=ondemand" >> /usr/local/etc/php-fpm.conf \
    && echo "pm.max_children=100" >> /usr/local/etc/php-fpm.conf \
    && echo "pm.process_idle_timeout=10s" >> /usr/local/etc/php-fpm.conf \
    && echo "pm.max_requests=500" >> /usr/local/etc/php-fpm.conf \
    && echo "request_terminate_timeout=900s" >> /usr/local/etc/php-fpm.conf \

COPY ./dev/config/xdebug.ini "${PHP_INI_DIR}/conf.d"

RUN curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.deb.sh' | bash
RUN apt install symfony-cli

WORKDIR /var/www/train_base

RUN usermod -u 1000 www-data
RUN chown 1000:www-data /var/www