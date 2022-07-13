# Tadas

Everyone has todos, but do you have Tadas? 🎉

Built with [Laravel](https://laravel.com/) and [Inertia](https://inertiajs.com/).

## Requirements

- [Lando](https://lando.dev/) ^3.6.0
- [Node](https://nodejs.org) ^18.3.0

## Getting Started

1.  Start the services

        lando start

2.  Install composer dependencies

        lando composer install

3.  Generate `.env` files

        ./scripts/generate.sh

4.  Run migrations

        lando php artisan migrate

5.  Install npm dependencies

        npm install

6.  Start the dev server

        npm run dev

## Releases

Unreleased features get the `@unreleased` tag applied to them.
To convert them to a `@since` tag, run the following:

```sh
npm run unreleased -- <tag>
```

Running this with `1.0.0` as the tag will convert all `@unreleased` tags to `@since 1.0.0`.
