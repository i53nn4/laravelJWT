# Commands

Build:

```sh
docker-compose build
```

Run:

```sh
docker-compose up
```

To run artisan commands:

```sh
docker exec -it php_composer bash
```

Create tables:

```sh
php artisan migrate
```

Popular with fake data:

```sh
php artisan db:seed
```
