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
        $data = User::all();

        dd($data);
    }

    public function create()
    {
        return view('User.register', ['type'=>$this->singularizeModel]);
    }

    public function store(Request $request)
    {
        // Store a newly created resource in storage
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
}
