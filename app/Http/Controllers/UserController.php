<?php
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id','desc')->get();
        return view('users.index', compact('users'));
    }
    public function create()
    {
        return view('users.create');
    }
    public function store(Request $request)
    {
        //validate the fields
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:users|email|max:255',
            'password' => 'required|between:8,255|confirmed',
            'password_confirmation' => 'required'
        ]);
        $user = new User;
        $user->name =$request->name;
        $user->email =$request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect('/users');
    }
    public function edit(User $user)
    {
        //
    }
    public function update(Request $request, User $user)
    {
        //
    }
    public function destroy(User $user)
    {
        //
    }
}
