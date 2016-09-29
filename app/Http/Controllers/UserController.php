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
        return view('user.index')->with('users', User::where('id', '!=', 1)->get());
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Requests\UserStoreRequest $request)
    {
        $user = new User($request->all());

        $user->password = bcrypt($user->password);

        $user->save();

        return redirect('system/users')->with('info', [$user->name . '添加成功']);
    }

    public function edit(Request $request, User $user)
    {
        $request->session()->flash('_old_input.nickname', $user->nickname);
        $request->session()->flash('_old_input.name', $user->name);
        $request->session()->flash('_old_input.email', $user->email);
        $request->session()->flash('_old_input.role', $user->role);

        return view('user.edit')->with($user->toArray());
    }

    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'nickname'  => 'required',
            'name'      => 'required',
            'repeat'    => 'same:password',
            'role'      => 'required',
        ]);

        $user->nickname = $request->input('nickname');
        $user->name = $request->input('name');
        $user->role = $request->input('role');
        $user->email = $request->input('email');
        $user->password = empty($request->input('password'))?$user->password:bcrypt($request->input('password'));

        $user->save();
        return redirect('system/users')->with('info', [$user->name . '修改成功']);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect('system/users')->with('info', [$user->name . '已经删除']);
    }
}
