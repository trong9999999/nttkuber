# Sử dụng ảnh PHP có sẵn từ Docker Hub
FROM php:7.4-apache
# FROM php:fpm

RUN docker-php-ext-install pdo pdo_mysql
# Sao chép mã nguồn vào container
COPY . /var/www/html/



# RUN pecl install xdebug && docker-php-ext-enable xdebug
# Mở cổng 80 để truy cập ứng dụng
EXPOSE 80

