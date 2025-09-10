<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\View\ComponentTagCompiler;

class FindProblematicView extends Command
{
    protected $signature = 'debug:find-view';
    protected $description = 'Find problematic view files';

    protected $files;
    protected $compiler;
    protected $tagCompiler;

    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
        $this->compiler = new BladeCompiler($files, config('view.compiled'));
        
        // Initialize the component tag compiler with empty arrays for aliases and namespaces
        $this->tagCompiler = new ComponentTagCompiler(
            [], // component aliases
            []  // component namespaces
        );
    }

    public function handle()
    {
        $this->info('Searching for problematic views...');
        
        // Check specific directories that might contain the problematic component
        $directories = [
            resource_path('views/filament'),
            resource_path('views/vendor/filament'),
            resource_path('views/vendor/filament-forms')
        ];
        
        foreach ($directories as $directory) {
            if ($this->files->exists($directory)) {
                $this->processDirectory($directory);
            }
        }
        
        $this->info('Search completed.');
        return 0;
    }
    
    protected function processDirectory($directory)
    {
        $this->line("Checking directory: " . str_replace(base_path(), '', $directory));
        
        $files = $this->files->allFiles($directory);
        
        foreach ($files as $file) {
            if (in_array($file->getExtension(), ['php', 'blade.php'])) {
                $this->checkFile($file->getPathname());
            }
        }
    }
    
    protected function checkFile($path)
    {
        $content = $this->files->get($path);
        
        // Look for the problematic component
        if (str_contains($content, 'x-filament::form') || 
            str_contains($content, 'x-filament-forms::form') ||
            str_contains($content, 'filament::form')) {
                
            $relativePath = str_replace(base_path() . '/', '', $path);
            $this->warn("Found potential issue in: {$relativePath}");
            
            // Show context
            $lines = file($path);
            $found = false;
            
            foreach ($lines as $lineNumber => $line) {
                if (str_contains($line, 'x-filament::form') || 
                    str_contains($line, 'x-filament-forms::form') ||
                    str_contains($line, 'filament::form')) {
                    
                    $this->line("  Line " . ($lineNumber + 1) . ": " . trim($line));
                    $found = true;
                }
            }
            
            if ($found) {
                $this->line('');
            }
        }
    }
}
