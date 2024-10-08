<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class MakeModelMCR extends Command
{
    protected $signature = 'make:modelv2 {name} {options} {user}';
    protected $description = 'Create a model with migration and a resource controller using make:c';
    private $allowedOptions = ['m', 'c', 'r', 'f'];
    // private $allowedTypes = ['User', 'Admin'];

    public function handle()
    {
        if (!$this->argument('user')){
            $user = "User";
        } else {
            $user = ucfirst(strtolower($this->argument('user')));
        }
        // if (!in_array($user, $this->allowedTypes)) {
        //     $this->error('Invalid type. Please use either "User" or "Admin".');
        //     return;
        // }

        $name = $this->argument('name');
        $options = str_split(strtolower($this->argument('options')));

        // Call the custom model command if name is not 'mcr' or 'mc'
        if (strtolower($name) !== 'mcr' && strtolower($name) !== 'mc') {
            $this->call('make:model-custom', ['name' => $name, 'user' => $user]);
        }

        // Iterate over the options
        foreach ($this->allowedOptions as $option) {
            if (in_array($option, $options)) {
                if ($option === 'c') {
                    if (in_array('r', $options)){
                        // Create a resource controller
                        $this->call("make:controller-v3", [
                            'user' => $user, // Pass the type as user
                            'name' => $name . 'Controller',
                        ], [
                            'memory_limit' => '4G'
                        ]);
                    } else {
                        $this->call("make:controller-v2", [
                            'name' => $name . 'Controller',
                            'user' => $user, // Pass the type as user
                        ], [
                            'memory_limit' => '4G'
                        ]);
                    }
                } elseif ($option === 'm') {
                    // Create a migration
                    $this->call('make:migration', [
                        'name' => 'create_' . strtolower(Str::plural($name)) . '_table',
                    ]);
                } else if ($option === 'f'){
                    $this->call('make:entity-factory', [
                        'name' => $name,
                    ]);
                }
            }
        }

        $this->info('Model, migration, and resource controller created successfully.');
    }
}
