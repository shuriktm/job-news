#!/bin/bash

# shellcheck disable=SC1091

set -o errexit
set -o nounset
set -o pipefail
# set -o xtrace # Uncomment this line for debugging purposes

# Load libraries
. /opt/bitnami/scripts/liblaravel.sh
. /opt/bitnami/scripts/libnews.sh

# Load Laravel environment
. /opt/bitnami/scripts/laravel-env.sh

# Ensure Laravel environment variables are valid
laravel_validate

# Ensure Laravel app is initialized
laravel_initialize

# Ensure News app is initialized
news_initialize

# Ensure all folders in /app are writable by the non-root "bitnami" user
chown -R bitnami:bitnami /app
