<?php

namespace App\Console\Commands;

use Illuminate\Routing\Console\ControllerMakeCommand;
use Symfony\Component\Console\Input\InputArgument;

class MakeC extends ControllerMakeCommand
{
    protected $name = 'make:controller-v2';
    protected $description = 'Create a new controller version 2';
    protected $type = 'Controller';

    protected function getStub()
    {
        // Point to a custom stub if you have one, otherwise use Laravel's default
        return base_path('stubs/Controller/default-controller.stub');
    }

    protected function getPath($name)
    {
        // Get the 'user' argument
        $user = $this->argument('user');
        // Ensure the correct path structure
        return base_path("entities/{$user}/Controller/{$name}.php");
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

    protected function getArguments()
    {
        return [
            ['controller-name', InputArgument::REQUIRED, 'The name of the controller'],
            ['user', InputArgument::REQUIRED, 'The user directory to place the controller in'],
        ];
    }
}
