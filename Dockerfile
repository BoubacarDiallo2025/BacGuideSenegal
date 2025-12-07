# Utiliser l'image PHP officielle avec Apache
FROM php:8.1-apache

# Installer les extensions PHP nécessaires
RUN docker-php-ext-install pdo pdo_mysql

# Activer les modules Apache nécessaires
RUN a2enmod rewrite
RUN a2enmod headers

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier les fichiers du projet dans le conteneur
COPY . .

# Créer un fichier .htaccess pour les redirections
RUN echo '<IfModule mod_rewrite.c>\n\
    RewriteEngine On\n\
    RewriteBase /\n\
    RewriteCond %{REQUEST_FILENAME} !-f\n\
    RewriteCond %{REQUEST_FILENAME} !-d\n\
    RewriteRule ^(.*)$ index.php [QSA,L]\n\
</IfModule>' > .htaccess

# Définir les permissions appropriées
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html

# Exposer le port 80
EXPOSE 80

# Démarrer Apache
CMD ["apache2-foreground"]
