#!/bin/bash

# Jalankan migrasi database saat server menyala
# (Hapus tanda '#' di bawah ini NANTI jika Anda sudah menghubungkan Render ke Database gratis seperti Supabase/Aiven)
php artisan migrate --force

# Jalankan web server Apache
apache2-foreground
