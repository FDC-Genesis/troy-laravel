<?php

namespace App\Console\Commands;

use Illuminate\Routing\Console\ControllerMakeCommand;

class MakeC2 extends ControllerMakeCommand {
    protected $signature = 'make:controller-v3 {name} {user}';
    protected $description = 'Create a new controller version 3';
    protected $type = 'Controller';

    protected function getStub() {
        return base_path('stubs/Controller/resource-controller.stub');
    }

    protected function getPath($name) {
        $user = $this->argument('user');
        return base_path("entities/{$user}/Controller/{$name}.php");
    }

    protected function buildClass($name) {
        $controllerClass = class_basename($name);
        $controllerNamespace = 'Entities\\' . $this->argument('user') . '\\Controller';
        $stub = $this->files->get($this->getStub());

        $replace = [
            '{{ namespace }}' => $controllerNamespace,
            '{{ class }}' => $controllerClass,
            '{{ extends }}' => "Core\\Controller\\{$this->argument('user')}\\AppController",
        ];

        return str_replace(array_keys($replace), array_values($replace), $stub);
    }
    
}
