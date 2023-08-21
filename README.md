> Инструкция по запуску проекта
> Подразумевается, что на машине уже установлен docker


### Установка
```bash
docker-compose build
```
```bash
docker volume create redis
```
```bash
docker-compose up -d
```
```bash
docker exec -it tradernet-php bash
```
```bash
composer install
```
```bash
cp .env.example .env
```

```bash
php artisan key:generate
```

### Запуск теста
```bash
php artisan test
```

### Запуск команды для получения курса валют за последние 180 дней
```bash
php artisan curs:last-days
```

### Запуск команды, которая слушает очередь
```bash
php artisan queue:work --tries=3
```
