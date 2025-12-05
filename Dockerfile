# Use Apache + PHP 8
FROM php:8.2-apache

# Enable Apache Rewrite (optional but recommended)
RUN a2enmod rewrite

# Copy your project into the web root
COPY . /var/www/html/

# Give correct permissions
RUN chown -R www-data:www-data /var/www/html

# Expose port Render uses
EXPOSE 80
