#!/bin/bash

# 🚀 Railway Database Import Script
# Quick script untuk import database ke Railway MySQL

echo "🚀 Railway Database Import"
echo "=========================="
echo ""

# Load credentials from .env file
ENV_FILE=".env"

if [ ! -f "$ENV_FILE" ]; then
    echo "❌ Error: .env file not found!"
    echo "   Path: $ENV_FILE"
    exit 1
fi

# Read credentials from .env
MYSQL_HOST=$(grep "^DB_HOST=" "$ENV_FILE" | cut -d '=' -f2 | tr -d '"' | tr -d "'")
MYSQL_PORT=$(grep "^DB_PORT=" "$ENV_FILE" | cut -d '=' -f2 | tr -d '"' | tr -d "'")
MYSQL_DATABASE=$(grep "^DB_DATABASE=" "$ENV_FILE" | cut -d '=' -f2 | tr -d '"' | tr -d "'")
MYSQL_USER=$(grep "^DB_USERNAME=" "$ENV_FILE" | cut -d '=' -f2 | tr -d '"' | tr -d "'")
MYSQL_PASSWORD=$(grep "^DB_PASSWORD=" "$ENV_FILE" | cut -d '=' -f2 | tr -d '"' | tr -d "'")

# SQL File path
SQL_FILE="/Users/tanziljws/Downloads/pira_webgalery (9).sql"

# Check if SQL file exists
if [ ! -f "$SQL_FILE" ]; then
    echo "❌ Error: SQL file not found!"
    echo "   Path: $SQL_FILE"
    echo ""
    echo "💡 Tip: Pastikan file SQL ada di Downloads folder"
    exit 1
fi

echo "📁 SQL File: $SQL_FILE"
echo "📊 Database: $MYSQL_DATABASE"
echo "🌐 Host: $MYSQL_HOST:$MYSQL_PORT"
echo ""

# Find MySQL client
MYSQL_CMD=$(which mysql 2>/dev/null)

# If not in PATH, try Homebrew location
if [ -z "$MYSQL_CMD" ]; then
    BREW_PREFIX=$(brew --prefix mysql-client 2>/dev/null)
    if [ -n "$BREW_PREFIX" ] && [ -f "$BREW_PREFIX/bin/mysql" ]; then
        MYSQL_CMD="$BREW_PREFIX/bin/mysql"
        export PATH="$BREW_PREFIX/bin:$PATH"
    fi
fi

# Check if MySQL client found
if [ -z "$MYSQL_CMD" ]; then
    echo "❌ Error: MySQL client not found!"
    echo ""
    echo "💡 Install MySQL client:"
    echo "   brew install mysql-client"
    echo ""
    echo "   Or add to PATH:"
    echo "   export PATH=\"\$(brew --prefix mysql-client)/bin:\$PATH\""
    exit 1
fi

# Ask if want to drop existing tables
echo "⚠️  Warning: Database mungkin sudah ada tabel"
echo "   Pilih opsi:"
echo "   1. Drop semua tabel dulu (fresh import)"
echo "   2. Skip error jika tabel sudah ada (continue)"
echo ""
read -p "Pilih (1/2) [default: 2]: " OPTION
OPTION=${OPTION:-2}

if [ "$OPTION" = "1" ]; then
    echo ""
    echo "🗑️  Dropping existing tables..."
    "$MYSQL_CMD" -h "$MYSQL_HOST" \
          -P "$MYSQL_PORT" \
          -u "$MYSQL_USER" \
          -p"$MYSQL_PASSWORD" \
          "$MYSQL_DATABASE" -e "
    SET FOREIGN_KEY_CHECKS = 0;
    DROP TABLE IF EXISTS agenda, cache, cache_locks, failed_jobs, foto, galery, gallery_activities, jobs, job_batches, kategori, migrations, news, otps, password_reset_tokens, petugas, prestasis, ratings, reports, sessions, suggestions, users;
    SET FOREIGN_KEY_CHECKS = 1;
    " 2>/dev/null
    echo "✅ Tables dropped (if existed)"
fi

echo ""
echo "⏳ Importing database..."
echo ""

# Import database
if [ "$OPTION" = "2" ]; then
    # Skip errors if tables exist
    "$MYSQL_CMD" -h "$MYSQL_HOST" \
          -P "$MYSQL_PORT" \
          -u "$MYSQL_USER" \
          -p"$MYSQL_PASSWORD" \
          "$MYSQL_DATABASE" < "$SQL_FILE" 2>&1 | grep -v "ERROR 1050" || true
else
    # Normal import (after drop)
    "$MYSQL_CMD" -h "$MYSQL_HOST" \
          -P "$MYSQL_PORT" \
          -u "$MYSQL_USER" \
          -p"$MYSQL_PASSWORD" \
          "$MYSQL_DATABASE" < "$SQL_FILE"
fi

# Check if import successful
if [ $? -eq 0 ]; then
    echo ""
    echo "✅ Database imported successfully!"
    echo ""
    echo "📋 Next steps:"
    echo "   1. ✅ Database imported! Credentials sudah ada di .env"
    echo "   2. Test connection: php artisan migrate:status"
    echo "   3. Deploy aplikasi ke Railway!"
else
    echo ""
    echo "❌ Error: Import failed!"
    echo ""
    echo "💡 Troubleshooting:"
    echo "   - Pastikan MySQL client terinstall"
    echo "   - Pastikan Railway credentials benar"
    echo "   - Pastikan database sudah dibuat di Railway"
    echo "   - Cek connection: mysql -h $MYSQL_HOST -P $MYSQL_PORT -u $MYSQL_USER -p"
    exit 1
fi

