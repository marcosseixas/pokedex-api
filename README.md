# pokedex-api
Api em laravel para atender um front de pokedex para brincar

Ahh mas você vai fazer mais uma api de pokemon? sim, porque? porque eu quero.

Para Inicializar o host sem ter que digitar http://localhost:80/ siga abaixo.

Vá para /etc/hosts e adicione 127.0.0.1 pokedex-api.local (Assim fica um pouco mais digno de se usar essa api dentro de outro projeto local).

use docker-compose up -d

dentro da pasta do projeto

chmod -R 777 storage

Acesse o container da aplicação e rode o Composer:

docker exec -it laravel-app bash
composer install
php artisan key:generate
