#!/bin/bash
#
# News environment library

# shellcheck disable=SC1091

# Load Generic Libraries
. /opt/bitnami/scripts/libfs.sh
. /opt/bitnami/scripts/liblog.sh
. /opt/bitnami/scripts/libos.sh
. /opt/bitnami/scripts/libnet.sh
. /opt/bitnami/scripts/libvalidations.sh

news_initialize() {
    info "Trying to connect to the database server"
    if ! retry_while "debug_execute wait-for-port --timeout 5 --host ${LARAVEL_DATABASE_HOST} ${LARAVEL_DATABASE_PORT_NUMBER}"; then
        error "Could not connect to the database"
        return 1
    fi

    if is_dir_empty "/app/vendor"; then
        info "Installing Composer dependencies"
        debug_execute composer install
    elif is_boolean_yes "$NEWS_UPDATE_AUTO"; then
        info "Updating Composer dependencies"
        debug_execute composer update
    else
        info "Composer dependencies are installed"
    fi

    if is_dir_empty "/app/node_modules" || is_boolean_yes "$NEWS_UPDATE_AUTO"; then
        info "Installing NodeJS dependencies"
        debug_execute npm install
    fi

    if [ ! -e "/app/.env" ]; then
        info "Creating .env file"
        cp /app/.env.example /app/.env

        info "Regenerating APP_KEY"
        debug_execute php artisan key:generate --ansi

        info "Executing database migrations"
        debug_execute php artisan migrate:fresh --seed --force
    elif is_boolean_yes "$NEWS_MIGRATE_AUTO"; then
        info "Executing database migrations"
        debug_execute php artisan migrate
    fi

    if [ ! -e "/app/public/storage" ]; then
        info "Creating symlink to public storage"
        debug_execute php artisan storage:link
    fi

    if is_boolean_yes "$NEWS_BUILD_DEV"; then
        info "Running Vite dev server on [http://localhost:5173]"
        npm run dev > /dev/null 2>&1 &
    elif is_boolean_yes "$NEWS_BUILD_AUTO" || [ -e "/app/public/hot" ] || is_dir_empty "/app/public/build"; then
        debug_execute rm -f /app/public/hot
        info "Building Vite assets"
        debug_execute npm run build
    fi

    if is_boolean_yes "$NEWS_CACHE"; then
        info "Caching Laravel config"
        debug_execute php artisan config:cache
        info "Caching Laravel routes"
        debug_execute php artisan route:cache
        info "Caching Laravel templates"
        debug_execute php artisan view:cache
        info "Caching Laravel events"
        debug_execute php artisan event:cache
    else
        info "Clearing Laravel cache"
        debug_execute php artisan optimize:clear
    fi

    # Avoid exit code of previous commands to affect the result of this function
    true
}
