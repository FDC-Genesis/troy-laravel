<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CustomMakeModel extends Command
{
    protected $signature = 'make:model-custom {name}';
    protected $description = 'Create a model with a custom stub';

    public function handle()
    {
        // Get the arguments
        $name = $this->argument('name');

        // Define the path where the model will be saved
        $path = base_path("entities/Model/{$name}.php");

        // Ensure the directory exists
        if (!File::exists(dirname($path))) {
            File::makeDirectory(dirname($path), 0755, true);
        }

        // Create the model using the custom stub
        $this->createModel($name, $path);
        
        $this->info("Model {$name} created successfully in {$path}");
    }

    protected function createModel($name, $path)
    {
        // Define the custom stub path (in the `stub` directory)
        $stub = base_path('stubs/Model/default-model.stub');

        // Check if the stub file exists
        if (!File::exists($stub)) {
            $this->error('Custom model stub not found in stub directory.');
            return;
        }

        // Get the content of the custom stub
        $stubContent = File::get($stub);

        // Replace the placeholders in the stub
        $modelContent = str_replace(
            ['{{ namespace }}', '{{ class }}'],
            ['Entities\\Model', $name],
            $stubContent
        );

        // Save the generated model content to the file path
        File::put($path, $modelContent);
    }
}
