# Extendeal Challange

[![N|Solid](https://camo.githubusercontent.com/316ccceb2c875497ee2197622c2040a241b8afe4ff78ab7cc0161ee2a644b8a3/68747470733a2f2f696d672e736869656c64732e696f2f62616467652f4c61726176656c2d4646324432303f7374796c653d666f722d7468652d6261646765266c6f676f3d6c61726176656c266c6f676f436f6c6f723d7768697465)](https://laravel.com/)

Events challange

## Features

- Event CRUD
- Event sales CRUD
- Auth Module
- Profile Module
- Laravel Sails
- Telescope
- Horizon
- Cached responses
- Dark mode

## Installation

Require [Docker](https://www.docker.com/) to run.

Install the dependencies and devDependencies and start the server.

```sh
git clone https://github.com/frannbian/vivetix-challange
cd vivetix-challange
cp .env.example .env
sudo chmod -R 777 ./
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install --ignore-platform-reqs
./vendor/bin/sail up
./vendor/bin/sail artisan key:generate
./vendor/bin/sail artisan migrate
./vendor/bin/sail artisan db:seed --class="UserSeeder"
npm install
npm run dev

```
After that the microservice will start at http//localhost, you'll see a documentation & playground as a home.
User: admin@events.com
Passwor: adm1n1strator.!

## Request & Responses 
For logs of the request & responses we gonna use "Laravel Telescope" a powerfull package for this feature.
¿How to use? Easy. Just go to http://localhost/telescope;

## License

Franco Bianco
