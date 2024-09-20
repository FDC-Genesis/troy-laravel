<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;


class MakeModelMCR extends Command
{
    protected $signature = 'make:modelmcr {name}';
    protected $description = 'Create a model with migration and a resource controller using make:c';

    public function handle()
    {
        $name = $this->argument('name');

        // Create the model
        $this->call('make:model', ['name' => $name]);

        // Create the migration
        $this->call('make:migration', ['name' => 'create_' . strtolower(Str::plural($name)) . '_table']);

        // Create the resource controller
        $this->call('make:c', [
            'name' => $name . 'Controller',
            '--resource' => true,
            '--model' => $name,
        ]);

        $this->info('Model, migration, and resource controller created successfully.');
    }
}
