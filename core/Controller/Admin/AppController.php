<?php

namespace Core\Controller\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AppController extends Controller
{
    //
    protected function isAuthenticated()
    {
        return Auth::check();
    }

    protected function getAuthenticatedUser()
    {
        return Auth::user();
    }
}
