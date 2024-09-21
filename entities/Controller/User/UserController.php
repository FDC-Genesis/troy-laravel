<?php

namespace Entities\Controller\User;

use Core\Controller\User\AppController;
use Entities\Model\User;
use Illuminate\Http\Request;

class UserController extends AppController
{
    public function index()
    {
        // Display a listing of the resource
        return view("{ucfirst($this->singularizeModel)}.index");
    }

    public function create()
    {
        return view('User.register', ['type'=>$this->singularizeModel]);
    }

    public function store(Request $request) {
        if ($request->isMethod('post')){
            // Attempt to authenticate the user
            return $this->handleRegister($request);
        } else if ($request->isMethod('put')){
            return $this->handleLogin($request);
        }
    }

    public function show($id)
    {
        // Display the specified resource
    }

    public function edit($id)
    {
        // Show the form for editing the specified resource
    }

    public function update(Request $request, $id)
    {
        // Update the specified resource in storage
    }

    public function destroy($id)
    {
        // Remove the specified resource from storage
    }

    public function login(){
        return view('User.login', ['type'=>$this->singularizeModel]);
    }

    public function logout(){
        return parent::logout();
    }
}
