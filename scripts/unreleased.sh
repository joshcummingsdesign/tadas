#!/usr/bin/env bash

source scripts/variables.sh

# Check for version number argument
if [[ -z $1 ]]; then
	printf "${RED}Version number required${NC}\n\n"
  exit 1
fi

# Run since-unreleased in the following directories
./vendor/bin/since-unreleased.sh database/ $1
./vendor/bin/since-unreleased.sh resources/js/ $1
./vendor/bin/since-unreleased.sh src/ $1
./vendor/bin/since-unreleased.sh tests/ $1

# Success
printf "\n${GREEN}Successfully updated version tags!${NC}\n\n"
