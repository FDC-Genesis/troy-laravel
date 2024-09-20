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
        return __DIR__.'/stubs/controller.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Http\Controllers';
    }
}
