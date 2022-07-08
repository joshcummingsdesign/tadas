# Tadas

Everyone has todos, but do you have tadas?

## Requirements

- [Lando](https://lando.dev/) ^3.6.0
- [Node](https://nodejs.org) ^18.3.0

## Getting Started

1. Copy `.env.example` to `.env`

        cp .env.example .env

2. Start the services

        lando start
 
4. Install composer dependencies

        lando composer install

5. Generate an app key

        lando php artisan key:generate

6. Run migrations

        lando php artisan migrate
 
7. Install npm dependencies

        npm install

8. Start the dev server

        npm run dev
