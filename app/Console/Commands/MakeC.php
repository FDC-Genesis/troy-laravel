<?php

namespace App\Console\Commands;

use Illuminate\Routing\Console\ControllerMakeCommand;

class MakeC extends ControllerMakeCommand
{
    protected $signature = 'make:controller-v2 {name} {user}';  // Correct signature
    protected $description = 'Create a new controller version 2';
    protected $type = 'Controller';

    protected function getStub()
    {
        return base_path('stubs/Controller/default-controller.stub');  // Custom stub path
    }

    protected function getPath($name)
    {
        // Get the 'user' argument
        $user = $this->argument('user');
        return base_path("entities/{$user}/Controller/{$name}.php");  // Ensure correct path structure
    }

    protected function buildClass($name)
    {
        // Use the default logic and replace with the custom namespace and base class
        $controllerNamespace = 'Entities\\' . $this->argument('user') . '\\Controller';

        $replace = [
            '{{ namespace }}' => $controllerNamespace,
            '{{ class }}' => class_basename($name),
            '{{ extends }}' => "Core\\Controller\\{$this->argument('user')}\\AppController"  // Custom base controller
        ];

        // Generate the content using the custom stub and placeholders
        return str_replace(
            array_keys($replace), array_values($replace), parent::buildClass($name)
        );
    }
}
