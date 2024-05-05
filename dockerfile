# Verwende das offizielle PHP-Basisimage
FROM php:8.3-fpm

# Setze das Arbeitsverzeichnis innerhalb des Containers
WORKDIR /var/www/html

# Kopiere die Dateien aus dem aktuellen Verzeichnis in das Arbeitsverzeichnis des Containers
COPY . .

# Installiere Composer
RUN apt-get update && \
    apt-get install -y zip unzip && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Installiere die erforderlichen PHP-Erweiterungen
RUN docker-php-ext-install pdo_mysql mysqli

# Installiere Node.js und npm
RUN apt-get update && \
    apt-get install -y curl && \
    curl -sL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs

# Setze die Datei- und Verzeichnisberechtigungen
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html/storage

# Exponiere den Port 9000
EXPOSE 9000

# Starte den PHP-FPM-Server
CMD ["php-fpm"]
