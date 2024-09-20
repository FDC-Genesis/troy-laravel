<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CustomMakeModel extends Command
{
    protected $signature = 'make:model-custom {name}';
    protected $description = 'Create a model with a custom stub';

    public function handle()
    {
        $name = $this->argument('name');
        $namespace = 'App\\Models'; // Adjust the namespace as needed
        $stubPath = base_path('stubs/model.stub');

        // Define the output path for the model
        $modelPath = app_path("Models/{$name}.php");

        // Load the stub content
        $stub = file_get_contents($stubPath);

        // Replace placeholders in the stub
        $content = str_replace(
            ['{{ namespace }}', '{{ class }}'],
            [$namespace, $name],
            $stub
        );

        // Save the new model file
        file_put_contents($modelPath, $content);

        // Output success message for model creation
        $this->info("Model {$name} created successfully at {$modelPath} with custom stub.");
    }
}
