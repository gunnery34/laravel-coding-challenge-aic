#!/bin/bash

DB_FILE="database/database.sqlite"

echo "Creating SQLite database at $DB_FILE..."

# Buat file sqlite jika belum ada
if [ ! -f "$DB_FILE" ]; then
  touch "$DB_FILE"
  echo "SQLite file created."
else
  echo "SQLite file already exists."
fi

# Jalankan migrasi
php artisan migrate --force
