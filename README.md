# Tadas

Everyone has todos, but do you have Tadas? 🎉

Built with [Laravel](https://laravel.com/) and [Inertia](https://inertiajs.com/).

## Requirements

- [Lando](https://lando.dev/) ^3.6.0
- [Node](https://nodejs.org) ^18.3.0

## Getting Started

1.  Copy `.env.example` to `.env`

        cp .env.example .env

2.  Start the services

        lando start

3.  Install composer dependencies

        lando composer install

4.  Generate an app key

        lando php artisan key:generate

5.  Run migrations

        lando php artisan migrate

6.  Install npm dependencies

        npm install

7.  Start the dev server

        npm run dev

## Releases

Unreleased features get the `@unreleased` tag applied to them.
To convert them to a `@since` tag, run the following:

```sh
npm run unreleased -- <tag>
```

Running this with `1.0.0` as the tag will convert all `@unreleased` tags to `@since 1.0.0`.
