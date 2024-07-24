# Сервис гостей

![me](https://github.com/POMXARK/guests-back/blob/develop/docs/guest-back-demo-docs.gif)

#### dev - запуск
```sh
 ./vendor/bin/sail up -d
docker exec -it guests-back-laravel.test-1 sh -c "php artisan migrate"
docker exec -it guests-back-laravel.test-1 sh -c "php artisan scribe:generate"
```

#### Исправить стиль кода
```sh
docker exec -it guests-back-laravel.test-1 sh -c "php ./vendor/bin/php-cs-fixer fix"
```

#### Тестирование
```sh
./vendor/bin/sail test
```

### Документация api (scribe)
```sh
http://127.0.0.1/docs
```
