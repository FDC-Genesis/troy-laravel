<?php

namespace Core\Controller\User;

use App\Http\Controllers\Controller;
use Entities\Model\User;
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
        $this->modelUsed = User::class;
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

        $user = $this->modelUsed::create($data);

        if ($user) {
            return redirect()->route('user.login')->with('success', 'User registered successfully.');
        } else {
            return redirect()->back()->withErrors(['error' => 'Failed to register user.'])->withInput();
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
            return redirect()->route('user.index');
        } else {
            // Authentication failed
            return redirect()->back()
                ->withErrors(['email' => 'Invalid email or password.'])
                ->withInput(); // Preserve old input
        }
    }    
}
