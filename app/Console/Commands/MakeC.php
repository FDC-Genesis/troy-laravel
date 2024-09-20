<?php

namespace App\Console\Commands;

use Illuminate\Routing\Console\ControllerMakeCommand;

class MakeC extends ControllerMakeCommand
{
    protected $name = 'make:c';
    protected $description = 'Create a new controller that extends AppController';
    protected $type = 'Controller';

    protected function buildClass($name)
    {
        $stub = parent::buildClass($name);
        return str_replace('extends Controller', 'extends AppController', $stub);
    }

    protected function getStub()
    {
        // Get the user argument
        $user = $this->argument('user');
        return __DIR__."/stubs/{$user}/controller.stub"; // Use curly braces to embed the variable
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        $user = $this->argument('user');
        return $rootNamespace.'\Http\Controllers\\'.$user;
    }
}
