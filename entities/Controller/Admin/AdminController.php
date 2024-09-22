<?php

namespace Entities\Controller\Admin;

use Core\Controller\Admin\AppController;
use Entities\Model\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends AppController
{
    public function index()
    {
        // Display a listing of the resource
        $onlineTime = Auth::user()->last_online;
        dd($onlineTime);
    }

    public function create()
    {
        // Show the form for creating a new resource
        return view('Admin.register');
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
        return view('Admin.login', ['type'=>$this->singularizeModel]);
    }

    public function logout(){
        return parent::logout();
    }
}
