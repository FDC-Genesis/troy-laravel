<?php

namespace Core\Controller\Admin;

use App\Http\Controllers\Controller;
use Entities\Model\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AppController extends Controller
{
    //
    protected $modelUsed;
    protected $pluralizeModel;
    protected $singularizeModel;
    
    public function __construct()
    {
        $this->modelUsed = Admin::class;
        [$this->pluralizeModel, $this->singularizeModel] = $this->getTableName($this->modelUsed);
    }

    protected function handleRegister($request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:' . $this->pluralizeModel . ',email',
            'password' => 'required|string|min:8|confirmed|regex:/[0-9]/',
        ]);

        if ($validator->fails()) {
            // Handle validation failure
            $errors = $validator->errors();
            return redirect()->back()
                ->withErrors($errors)
                ->withInput();
        }

        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        unset($data['password_confirmation']);

        $admin = $this->modelUsed::create($data);

        if ($admin) {
            return redirect()->route('admin.login')->with('success', 'Admin registered successfully.');
        } else {
            return redirect()->back()->withErrors(['error' => 'Failed to register admin.'])->withInput();
        }
    }

    protected function handleLogin($request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        if ($validator->fails()) {
            // Handle the validation failure
            $errors = $validator->errors();
            return redirect()->back()
                ->withErrors($errors)
                ->withInput(); // Preserve old input
        }

        // Attempt to log in the user
        if (Auth::guard($this->singularizeModel)->attempt(['email' => $request->email, 'password' => $request->password])) {
            // Authentication passed
            $this->lastLoggedIn($this->singularizeModel);
            return redirect()->route('admin.index');
        } else {
            // Authentication failed
            return redirect()->back()
                ->withErrors(['email' => 'Invalid email or password.'])
                ->withInput(); // Preserve old input
        }
    }    
}
