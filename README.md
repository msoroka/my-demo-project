# My demo project

Showcase of my Pimcore skills.

## 1. Getting started

### 1.1. Clone this repository

### 1.2. Copy env

```bash
cp .env.example .env
```

### 1.3. Fill env variables

```bash
APP_ENV=

MYSQL_ROOT_PASSWORD=
MYSQL_DATABASE=
MYSQL_USER=
MYSQL_PASSWORD=

NGINX_PORT=
```

### 1.4. Run docker-compose command

```bash
docker-compose up
```

### 1.5. Get into php-debug container, install dependencies and Pimcore, then fix permissions

```bash
docker-compose exec php-debug bash
COMPOSER_MEMORY_LIMIT=-1 composer install
vendor/bin/pimcore-install --mysql-host-socket=db --mysql-username=MYSQL_USER --mysql-password=MYSQL_PASSWORD --mysql-database=MYSQL_DATABASE
chown -R www-data:www-data var/*
```

Xdebug is running on port 9003 by default. You can check xdebug config by running command below in fpm-debug container

```bash
cat /usr/local/etc/php/conf.d/20-xdebug.ini
```



## 2. Source code analysis

### 2.1. PHPStan

```bash
docker exec -it my-demo-project-php-debug vendor/bin/phpstan analyse src 
```
or with a rule level

```bash
docker exec -it my-demo-project-php-debug vendor/bin/phpstan analyse src --level 8 #level from 1 to 8  
```
more [PHPStan docs](https://phpstan.org/user-guide/getting-started)