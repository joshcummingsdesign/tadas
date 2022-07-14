#!/usr/bin/env bash

# Generate IDE helpers
lando php artisan ide-helper:generate
lando php artisan ide-helper:models -M --dir="src"
lando php artisan ide-helper:meta
