<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeController extends Command
{
    protected $signature = 'make:controller {controllerName}';
    protected $description = 'Create a new controller';

    protected function appPath($path = '')
    {
        return app()->basePath() . '/app' . ($path ? '/' . $path : $path);
    }

    public function handle()
    {
        $controllerName = $this->argument('controllerName');
        $modelPath = $this->appPath("Http/Controllers/{$controllerName}.php");

        if (file_exists($modelPath)) {
            $this->error('Controller already exists!');
            return;
        }

        $stub = file_get_contents(__DIR__.'/stubs/controller.stub');
        $stub = str_replace('{{controllerName}}', $controllerName, $stub);

        file_put_contents($modelPath, $stub);

        $this->info('Controller created successfully!');
    }
}