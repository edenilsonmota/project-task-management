# Usar a imagem base do PHP 8.2 com FPM
FROM php:8.2-fpm

# Atualizar os pacotes e instalar as extensões necessárias
RUN apt-get update && apt-get install -y \
    libonig-dev \
    libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Instalar o Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

# Comando padrão para iniciar o PHP-FPM
CMD ["php-fpm"]
