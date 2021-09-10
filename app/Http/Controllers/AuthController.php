<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }
    public function store(Request $request)
    {
        $credentials = $request()->only('email','password');
        if(Auth::attempt($credentials)){
            $request()->session()->regenerate();
            return redirect('users');
        }
        return redirect('login');
    }
}