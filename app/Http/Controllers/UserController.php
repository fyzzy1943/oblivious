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

    public function index()
    {
        return view('user.index')->with('users', User::all());
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Requests\UserStoreRequest $request)
    {
        $user = new User($request->all());

        $user->password = bcrypt($user->password);
        $user->email = '';

        $user->save();

        return redirect('system/users')->with('info', [$user->name . '添加成功']);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect('system/users')->with('info', [$user->name . '已经删除']);
    }
}
