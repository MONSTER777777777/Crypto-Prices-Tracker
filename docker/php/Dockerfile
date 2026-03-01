FROM php:8.4-fpm

# Argumentos
ARG user=crypto
ARG uid=1000

# Instalar dependências do sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libpq-dev \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalar extensões PHP
RUN docker-php-ext-install mbstring exif pcntl bcmath gd pdo_pgsql


# Instalar Redis extension
RUN pecl install redis && docker-php-ext-enable redis

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Criar usuário do sistema (useradd evita erro 51)
RUN useradd -m -u $uid -G www-data,root $user

# Criar diretório .composer com permissões corretas
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Definir diretório de trabalho
WORKDIR /var/www

USER $user

EXPOSE 9000
CMD ["php-fpm"]