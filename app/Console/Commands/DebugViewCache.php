<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use App\Services\CustomBladeCompiler;

class DebugViewCache extends Command
{
    protected $signature = 'debug:view-cache';
    protected $description = 'Debug view caching issues';

    protected $compiler;
    protected $files;

    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
        $this->compiler = new CustomBladeCompiler($files, config('view.compiled'));
    }

    public function handle()
    {
        $viewsPath = resource_path('views');
        $files = $this->files->allFiles($viewsPath);
        $processed = 0;
        $failed = 0;

        $this->info("Starting view compilation check...");
        $this->line("");

        foreach ($files as $file) {
            if (in_array($file->getExtension(), ['php', 'blade.php'])) {
                $path = $file->getPathname();
                $relativePath = str_replace(base_path() . '\\', '', $path);
                $processed++;
                
                // Skip vendor files for now
                if (strpos($relativePath, 'vendor') !== false) {
                    continue;
                }

                try {
                    // Read the file content
                    $content = $this->files->get($path);
                    
                    // Try to compile the content
                    $this->compiler->compileString($content);
                    $this->info("✓ [{$processed}] Compiled: {$relativePath}");
                } catch (\Exception $e) {
                    $failed++;
                    $this->error("\n✗ [{$processed}] Failed to compile: {$relativePath}");
                    $this->error("   Error: " . $e->getMessage());
                    
                    // Show file information
                    $this->line("");
                    $this->line("File content preview:");
                    $this->line(str_repeat("-", 80));
                    
                    // Show file content with line numbers
                    $lines = file($path);
                    $errorLine = $e->getLine() - 1;
                    $startLine = max(0, $errorLine - 5);
                    $endLine = min(count($lines) - 1, $errorLine + 5);
                    
                    for ($i = $startLine; $i <= $endLine; $i++) {
                        $line = rtrim($lines[$i]);
                        $lineNum = str_pad($i + 1, 4, ' ', STR_PAD_LEFT);
                        $prefix = ($i === $errorLine) ? ' >> ' : '    ';
                        $this->line($prefix . $lineNum . ' | ' . $line);
                    }
                    
                    $this->line(str_repeat("-", 80));
                    $this->line("");
                    
                    // Ask if user wants to continue
                    if (!$this->confirm('Continue checking other files?', true)) {
                        break;
                    }
                }
            }
        }

        $this->line("");
        $this->info("View compilation check completed!");
        $this->info("Processed: {$processed} files");
        $this->info("Failed:    {$failed} files");
        
        if ($failed > 0) {
            $this->error("\nThere were {$failed} view compilation errors. Please check the output above for details.");
            return 1;
        }
        
        $this->info("\nAll views compiled successfully!");
        return 0;
    }
}
