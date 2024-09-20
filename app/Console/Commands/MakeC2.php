<?php

namespace App\Console\Commands;

use Illuminate\Routing\Console\ControllerMakeCommand;

class MakeC2 extends ControllerMakeCommand
{
    protected $name = 'make:c2 {user}'; // Add user argument
    protected $description = 'Create a new controller that extends AppController';
    protected $type = 'Controller';

    protected function buildClass($name)
    {
        $stub = parent::buildClass($name);
        return str_replace('extends Controller', 'extends AppController', $stub);
    }

    protected function getStub()
    {
        // Get the user argument for the stub path
        $user = $this->argument('user');
        return __DIR__."/stubs/{$user}/controller2.stub"; // Adjust path based on user
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        $user = $this->argument('user');
        return $rootNamespace.'\Http\Controllers\\'.$user;
    }
}
