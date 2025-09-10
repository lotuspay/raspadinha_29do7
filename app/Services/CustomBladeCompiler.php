<?php

namespace App\Services;

use Illuminate\View\Compilers\BladeCompiler as BaseBladeCompiler;
use Illuminate\View\ComponentTagCompiler;

class CustomBladeCompiler extends BaseBladeCompiler
{
    public function compile($path = null)
    {
        if ($path) {
            $this->setPath($path);
        }

        if (!is_null($this->cachePath)) {
            $contents = $this->compileString($this->files->get($this->getPath()));

            $compiledPath = $this->getCompiledPath($this->getPath());

            $this->files->ensureDirectoryExists(dirname($compiledPath), 0777, true);

            $this->files->put($compiledPath, $contents, true);
        }
    }

    protected function compileComponentTags($value)
    {
        if (!$this->compilesComponentTags) {
            return $value;
        }

        return (new ComponentTagCompiler(
            $this->classComponentAliases, $this->classComponentNamespaces, $this
        ))->compile($value);
    }
}
