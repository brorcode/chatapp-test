## Запуск проекта

1. Клонировать репозиторий
2. В папке с проектом запустить команды поочереди
   1. Для Docker v2 
    ```sh
    docker compose build

    docker compose up -d

    cp .env.example .env

    docker compose exec app composer install

    docker compose exec app php artisan key:generate

    docker compose exec app php artisan migrate --seed
    ```
    2. Или если локально используется устаревший Docker
    ```sh
    docker-compose build

    docker-compose up -d

    cp .env.example .env

    docker-compose exec app composer install

    docker-compose exec app php artisan key:generate

    docker-compose exec app php artisan migrate --seed
    ```

REST API GET запрос для получения списка чатов:
http://localhost:8080/api/v1/chats

для навигации:
http://localhost:8080/api/v1/chats?page=2

Для тестов запустить
```sh
docker compose exec app php artisan test
```
или
```sh
docker-compose exec app php artisan test
```

## Примечание
Инструкция протестирована только на macOS c Docker Desktop.
