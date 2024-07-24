# Сервис гостей

#### dev - запуск
```sh
 ./vendor/bin/sail up -d
docker exec -it guests-back-laravel.test-1 sh -c "php artisan migrate"
```

#### Тестирование
```sh
./vendor/bin/sail test
```
