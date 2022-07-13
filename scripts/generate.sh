#!/usr/bin/env bash

source scripts/variables.sh

# Generate .env
rm -rf .env .env.testing
cp .env.example .env

# Generate app key
lando php artisan key:generate

# Generate .env.testing
cp .env .env.testing
sed -i 's/DB_HOST=database/DB_HOST=database_testing/g' .env.testing

# Success
printf "\n${GREEN}Successfully generated .env and .env.testing${NC}\n\n"
