<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class AdminController extends Controller
{
    //
    public function index(){
        return Inertia::render('Admin/Login/Login');
    }

    public function indexAdmin(){
        return Inertia::render('Admin/Index');
    }

    public function login(LoginRequest $request){
        if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password])){
            return Redirect::route('DashboardIndex');
        }
    }
}
