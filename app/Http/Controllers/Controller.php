<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

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

    protected function lastLogout($modelName){

    }

    protected function lastLoggedIn($modelName)
    {
        // Dynamically resolve the model name using the correct namespace
        $modelClass = MODEL_DIR . ucfirst($modelName);
    
        if (class_exists($modelClass)) {
            // Get the authenticated user from the specified guard
            $user = Auth::guard($modelName)->user();
    
            if ($user) {
                // Instantiate the model class and update the last_online field
                $model = new $modelClass();
                $model->where('id', $user->id)->update(['last_online' => now()]);
    
                // Optionally update the Auth user's in-memory last_online timestamp (if needed)
                $user->last_online = now();
            }
        }
    }

    public function logout($modelName) {
        Auth::guard($modelName)->logout();
        return redirect()->route("{$modelName}.signin");
    }
}
