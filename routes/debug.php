<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use Illuminate\View\Compilers\BladeCompiler;

Route::get('/debug-view-cache', function () {
    $compiler = new BladeCompiler(app('files'), config('view.compiled'));
    $files = File::allFiles(resource_path('views'));
    
    foreach ($files as $file) {
        if ($file->getExtension() === 'php' || $file->getExtension() === 'blade.php') {
            $path = $file->getPathname();
            try {
                $compiler->compile($path);
                echo "Compiled successfully: {$path}<br>";
            } catch (\Exception $e) {
                return response()->json([
                    'error' => $e->getMessage(),
                    'file' => $path,
                    'line' => $e->getLine(),
                    'trace' => $e->getTraceAsString()
                ], 500);
            }
        }
    }
    
    return 'All views compiled successfully!';
});
