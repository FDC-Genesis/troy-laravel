<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    protected function getTableName($model)
    {
        $modelName = (new \ReflectionClass($model))->getShortName();
    
        // Handle irregular pluralization
        if (substr($modelName, -1) === 'y') {
            $pluralizeModel = strtolower(substr($modelName, 0, -1) . 'ies'); // e.g., Category -> Categories
        } else {
            $pluralizeModel = strtolower($modelName . 's'); // Default pluralization
        }
    
        return [$pluralizeModel, strtolower($modelName)];
    }
}
