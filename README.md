## Search and Stay Backend Code Challenge

Technologies:
 - Laravel 11
 - PHP 8.3
 - Mysql8.0

Requirements to run:
 - Docker compose
### How to set up a working environment
    1 - cp .env.docker.example .env
    2 - make up
    3 - make composer-install
    4 - docker-compose exec app php artisan key:generate
    5 - make migrate

The application will run in the port 8081

#### This projected is documented with openapi 3.0, the docs are  in the openapi.yaml file.


