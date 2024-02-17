<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeModel extends Command
{
    protected $signature = 'make:model {modelName}';
    protected $description = 'Create a new model';

    protected function appPath($path = '')
    {
        return app()->basePath() . '/app' . ($path ? '/' . $path : $path);
    }

    public function handle()
    {
        $modelName = $this->argument('modelName');
        $modelPath = $this->appPath("Models/{$modelName}.php");

        if (file_exists($modelPath)) {
            $this->error('Model already exists!');
            return;
        }

        $stub = file_get_contents(__DIR__.'/stubs/model.stub');
        $stub = str_replace('{{modelName}}', $modelName, $stub);

        file_put_contents($modelPath, $stub);

        $this->info('Model created successfully!');
    }
}
