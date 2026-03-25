FROM php:8.2-apache

# Instalar extensión de MySQL para PHP
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Habilitar mod_rewrite de Apache
RUN a2enmod rewrite

# Directorio de trabajo
WORKDIR /var/www/html

# Copiar fuentes al contenedor
COPY src/ /var/www/html/

EXPOSE 80
```

**`.env.example`** ← Cada integrante crea su propio `.env` basado en este
```
DB_HOST=mysql
DB_NAME=proyecto_db
DB_USER=usuario
DB_PASSWORD=contraseña123
DB_ROOT_PASSWORD=root123
```

**`.gitignore`**
```
.env
mysql_data/
vendor/