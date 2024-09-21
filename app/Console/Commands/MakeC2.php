<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeC2 extends Command {
    protected $signature = 'make:controller-v3 {name} {user}';
    protected $description = 'Create a new controller version 3';

    public function handle() {
        ini_set('memory_limit', '4G'); // Increase memory limit here

        $name = $this->argument('name');
        $user = $this->argument('user');

        // Get the path where the file will be saved
        $path = base_path("entities/Controller/{$user}/{$name}.php");
        $path2 = "entities/Controller/{$user}/{$name}.php";
        // Ensure the directory exists
        $directory = dirname($path);
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true); // Create the directory if it doesn't exist
        }

        // Build the class content
        $controllerClass = class_basename($name);
        $controllerNamespace = "Entities\\Controller\\{$user}"; // Correct namespace
        $stub = file_get_contents(base_path('stubs/Controller/resource-controller.stub'));

        // Replace placeholders in the stub
        $replace = [
            '{{ namespace }}' => $controllerNamespace,
            '{{ class }}' => $controllerClass,
            '{{ extends }}' => "Core\\Controller\\{$user}\\AppController", // Base class
        ];

        $content = str_replace(array_keys($replace), array_values($replace), $stub);

        // Save the content to the specified path using native PHP
        if (file_put_contents($path, $content) !== false) {
            $this->info("Controller created successfully at: {$path2}");
        } else {
            $this->error("Failed to create controller.");
        }
    }
}
