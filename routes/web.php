<?php

use App\Http\Middleware\CheckForMaintenanceMode;
use Illuminate\Support\Facades\Route;

// public routes
Route::middleware([CheckForMaintenanceMode::class])->group(function() {
    $directory = base_path('routes/public');

    $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory));

    foreach ($files as $file) {
        if ($file->isFile() && $file->getExtension() === 'php') {
            require $file->getPathname();
        }
    }
});