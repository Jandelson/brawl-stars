# Use uma imagem oficial do PHP 8.3
FROM php:8.3-fpm

# Instale dependências básicas do sistema
RUN apt-get update && apt-get install -y \
    curl \
    zip \
    unzip \
    git \
    libonig-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libxml2-dev \
    libzip-dev \
    libpq-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql zip opcache intl bcmath

# Instale o Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Configure permissões
RUN mkdir -p /var/www \
    && chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www

# Configure o ambiente de trabalho
WORKDIR /var/www

# Exponha a porta para o PHP-FPM
EXPOSE 9000

# Comando padrão para o contêiner
CMD ["php-fpm"]
