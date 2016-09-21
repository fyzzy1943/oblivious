<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showList()
    {

    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Requests\UserStoreRequest $request)
    {
        $user = new User($request->all());

        dd($user);
    }
}
