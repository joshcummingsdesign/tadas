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

3. Generate an app key

        lando php artisan key:generate

4. Run migrations

        lando php artisan migrate
 
5. Install the project dependencies

        npm install

6. Start the project watcher

        npm run dev
