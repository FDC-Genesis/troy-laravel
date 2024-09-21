<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeEntityFactory extends Command
{
    protected $signature = 'make:entity-factory {name}';
    protected $description = 'Create a new factory for an entity model';

    public function handle()
    {
        $name = $this->argument('name');
        $model = "Entities\\Model\\" . $name;
        $path = database_path("factories/Entities/Model/{$name}Factory.php");

        $this->createFactory($name, $model, $path);
    }

    protected function createFactory($name, $model, $path)
    {
        if (File::exists($path)) {
            $this->error("Factory for {$name} already exists!");
            return;
        }

        $stub = file_get_contents(base_path('stubs/Factory/factory.stub'));

        $stub = str_replace(['{{ class }}', '{{ model }}'], [$name . 'Factory', $model], $stub);

        File::ensureDirectoryExists(dirname($path));
        File::put($path, $stub);

        $this->info("Factory created successfully: {$path}");
    }
}
