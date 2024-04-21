#!/usr/bin/env bash

echo "[*] Setup admin account"
sed -i -r "s/ADMIN_PW=.+/ADMIN_PW=`cat /dev/urandom | tr -dc A-Za-z0-9_ | head -c 28`/g" .env
sed -i -r "s/ADMIN_KEY=.+/ADMIN_KEY=`cat /dev/urandom | tr -dc A-Za-z0-9_ | head -c 16`/g" .env

docker compose up --build -d

echo "[*] Waiting ..."
sleep 30

echo "[*] Initialize database"
docker compose exec -it php php artisan migrate
docker compose exec -it php php artisan db:seed --class UsersTableSeeder

echo "[*] Initialize flag note"
docker compose exec -it bot node init_note.js

echo "[*] Everything is done"