<?php
// Fix suggestions status column directly
require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

try {
    echo "Fixing suggestions status column...\n";
    
    // Alter table to increase status column length
    DB::statement("ALTER TABLE `suggestions` MODIFY COLUMN `status` VARCHAR(50) DEFAULT 'pending'");
    
    echo "✓ Success! Status column has been updated to VARCHAR(50)\n";
    echo "Now you can use longer status values like 'approved', 'rejected', etc.\n";
    
} catch (Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
}
