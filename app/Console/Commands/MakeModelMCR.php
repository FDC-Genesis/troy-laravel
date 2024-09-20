<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class MakeModelMCR extends Command
{
    protected $signature = 'make:modelv2 {name} {options}';
    protected $description = 'Create a model with migration and a resource controller using make:c';
    private $allowedOptions = ['m', 'c', 'r'];

    public function handle()
    {
        $name = $this->argument('name');
        $options = str_split(strtolower($this->argument('options')));

        // Call the custom model command
        if (strtolower($name) !== 'mcr' && strtolower($name) !== 'mc') {
            $this->call('make:model-custom', ['name' => $name]);
        }

        // Iterate over the options
        foreach ($this->allowedOptions as $option) {
            if (in_array($option, $options)) {
                if ($option == 'c' && in_array('r', $options)) {
                    // Create a resource controller
                    $this->call('make:c2', [
                        'name' => $name . 'Controller',
                        '--resource' => true,
                        '--model' => $name,
                    ]);
                } elseif ($option == 'm') {
                    // Create a migration
                    $this->call('make:migration', [
                        'name' => 'create_' . strtolower(Str::plural($name)) . '_table',
                    ]);
                } elseif ($option == 'c') {
                    // Create a basic controller
                    $this->call('make:c', [
                        'name' => $name . 'Controller',
                    ]);
                }
            }
        }

        $this->info('Model, migration, and resource controller created successfully.');
    }
}
