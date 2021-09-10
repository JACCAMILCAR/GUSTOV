<?php
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
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
            'name' => 'required|string|max:255',
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
        return view('users.edit', compact('user'));
    }
    public function update(Request $request, User $user)
    {
        //validate the fields
        $request->validate([
            'name' => 'required|max:255|string',
            'email' => 'required|email|max:255',
            'password' => 'confirmed'
        ]);
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password != null){
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return redirect('users');
    }
    public function destroy(User $user)
    {
        $id = $user->id;
        $users = DB::select('select u.id
                            from receipts r, users u
                            where u.id ='.$id.'
                            and u.id = r.userId
                            ');
        if($users==null){
            $user->delete();
            return redirect('/users');
        }else{
            return redirect('/users')->with('Message','Error when deleting the user, because it is linked to a receipt.');
        }
    }
}